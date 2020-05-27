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

    public function mount($notable)
    {
            $this->notable_id = $notable->id;
            $this->notable_type = get_class($notable);
    }

    public function render()
    {
        $notes = Note::where('notable_type',$this->notable_type)
            ->where('notable_id',$this->notable_id)
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
                'user_id' => Auth::id(),
            ]);
            $this->newnote = '';
            $this->dirtyNote = false;

            $this->emit('noteAdded');
        }
    }

}
