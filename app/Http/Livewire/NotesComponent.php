<?php

namespace App\Http\Livewire;

use App\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotesComponent extends Component
{
    public $notable_id;
    public $notable_type;
    public $newnote = '';
    public $dirtyNote = false;
    public $memo;
    public $pinned;
    public $editing;
    public $confirming;

    protected $listeners=['editoropen','closed'];

    public function mount($notable)
    {
            $this->notable_id = $notable->id;
            $this->notable_type = get_class($notable);
    }

    public function render()
    {
        $notes = Note::where('notable_type',$this->notable_type)
            ->where('notable_id',$this->notable_id)
            ->orderBy('pinned','desc')
            ->latest()
            ->get();

        return view('admin.notes.notes-component')->withNotes($notes);
    }

    public function updatedNewnote()
    {
        $this->dirtyNote = strlen($this->newnote) > 10;     //must type more than 10 characters
    }

    public function saveNote()
    {
        if ($this->dirtyNote) {
            Note::create([
                'notable_id' => $this->notable_id,
                'notable_type' => $this->notable_type,
                'memo' => $this->newnote,
                'pinned' => 0,
                'user_id' => Auth::id(),
            ]);
            $this->newnote = '';
            $this->dirtyNote = false;

            $this->emit('noteAdded');
        }
    }

    public function editoropen($id)
    {
        $note = Note::findOrFail($id);
        $this->memo = $note->memo;
        $this->pinned = $note->pinned;
        $this->editing = $id;
    }

    public function updateNote()
    {
        $data = $this->validate([
            'memo' => 'required|max:4000|min:10',
        ]);

        $note = Note::findOrFail($this->editing);
        $note->memo = $data['memo'];
        $note->pinned = $this->pinned;
        $note->user_id = Auth::id();
        $note->save();
        return $this->closed();
    }

    public function closed()
    {   
        $this->memo = null;
        $this->pinned = null;
        $this->editing = null;
        $this->confirming = null;
        $this->dispatchBrowserEvent('closemodal');
    }

    public function confirmDelete()
    {
        $this->confirming = $this->editing;
    }

    public function kill()
    {
        Note::find($this->editing)->delete();
        return $this->closed();
    }
}
