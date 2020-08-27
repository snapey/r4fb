<?php

namespace App\Http\Livewire;

use App\Attachment;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class NotesComponent extends Component
{
    use WithFileUploads;

    public $notable_id;
    public $notable_type;
    public $newnote = '';
    public $dirtyNote = false;
    public $memo;
    public $pinned; 
    public $external; 
    public $editing;
    public $note_id;
    public $confirming;
    public $attachment;
    public $iteration=1;
    public $attachments=[];

    protected $listeners=['editoropen','closed'];

    public function mount($notable)
    {
            $this->notable_id = $notable->id;
            $this->notable_type = get_class($notable);
    }

    public function render()
    {
        $notes = Note::where('notable_type',$this->notable_type)
            ->with('attachments')
            ->where('notable_id',$this->notable_id)
            ->orderBy('pinned','desc')
            ->latest()
            ->get();

        return view('admin.notes.notes-component')->withNotes($notes);
    }

    public function updatedMemo()
    {
        $this->dirtyNote = strlen($this->memo) > 10;     //must type more than 10 characters
    }

    public function saveNote()
    {
        $data = $this->validate([
            'memo' => 'required|max:4000|min:10',
        ]);

        if ($this->dirtyNote) {
            Note::create([
                'notable_id' => $this->notable_id,
                'notable_type' => $this->notable_type,
                'memo' => $this->memo,
                'pinned' => $this->pinned ?? 0,
                'external' => $this->external ?? 0,
                'user_id' => Auth::id(),
            ]);

            $this->emit('noteAdded');
            return $this->closed();

        }
    }

    public function editoropen($id)
    {
        $note = Note::with('attachments')->findOrNew($id);
        $this->memo = $note->memo;
        $this->pinned = $note->pinned;
        $this->external = $note->external;
        $this->editing = true;
        $this->note_id = $id;
        $this->attachments = $note->attachments->toArray();
    }

    public function updateNote()
    {
        $data = $this->validate([
            'memo' => 'required|max:4000|min:10',
        ]);

        $note = Note::findOrFail($this->note_id);
        $note->memo = $data['memo'];
        $note->pinned = $this->pinned ?? 0 ;
        $note->external = $this->external ?? 0;
        $note->user_id = Auth::id();
        $note->save();
        return $this->closed();
    }

    public function closed()
    {   
        $this->memo = null;
        $this->pinned = null;
        $this->closed = null;
        $this->editing = null;
        $this->confirming = null;
        $this->attachment = null;
        $this->iteration++; // ensures file input is replaced
        $this->dispatchBrowserEvent('closemodal');
    }

    public function confirmDelete()
    {
        $this->confirming = $this->note_id;
    }

    public function kill()
    {
        Note::find($this->confirming)->delete();
        return $this->closed();
    }


    // attachments

    public function updatedAttachment()
    {
        $this->validate([
            'attachment' => 'mimes:png,jpeg,pdf|max:8096', // 8MB Max
        ]);
    }

    public function saveAttachment()
    {
        //ensure we have a saved note
        if(is_null($this->note_id)) {
            $note = Note::create([
                'notable_id' => $this->notable_id,
                'notable_type' => $this->notable_type,
                'memo' => $this->memo ?? 'Untitled note',
                'pinned' => $this->pinned ?? 0,
                'external' => $this->external ?? 0,
                'user_id' => Auth::id(),
            ]);
            $this->note_id = $note->id;
            $this->memo = $note->memo;
        } else {
            $note = Note::find($this->note_id);
        }

        $filename = sprintf('%s-%s-%s.%s',
            $this->notable_id,
            str_slug($this->notable_type),
            str_random(16),
            $this->attachment->extension()
        );

        $this->attachment->storeAs(now()->format('Y-m'), $filename, 'uploads');
        Storage::disk('uploads')->setVisibility(now()->format('Y-m') . '/' . $filename,'public');

        $att = new Attachment();
        $att->path = now()->format('Y-m') . '/' . $filename;
        $att->label = $this->attachment->getClientOriginalName();
        $att->user_id = Auth::id();

        $note->attachments()->save($att);

        $this->attachments = $note->attachments->toArray();

        //clean up
        $this->attachment=null;
        $this->iteration++;
    }
}
