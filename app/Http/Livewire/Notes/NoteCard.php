<?php

namespace App\Http\Livewire\Notes;

use Livewire\Component;

class NoteCard extends Component
{
    public $note;

    public function mount($note)
    {
        $this->note = $note;
    }

    public function render()
    {
        return view('livewire.notes.note-card');
    }
}
