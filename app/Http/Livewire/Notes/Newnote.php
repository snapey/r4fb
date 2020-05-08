<?php

namespace App\Http\Livewire\Notes;

use App\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Newnote extends Component
{
    public $model_id;
    public $model_name;
    public $newnote = '';
    public $dirtyNote = false;

    public function mount($model)
    {
        $this->model_id = $model->id;
        $this->model_name = get_class($model);
    }

    public function render()
    {
        return view('livewire.notes.newnote');
    }

    public function updatedNewnote()
    {
        $this->dirtyNote = strlen($this->newnote) > 10;     //must type more than 10 characters
    }

    public function saveNote()
    {
        if ($this->dirtyNote) {
            Note::create([
                'notable_id' => $this->model_id,
                'notable_type' => $this->model_name,
                'memo' => $this->newnote,
                'user_id' => Auth::id(),
            ]);
            $this->newnote = '';
            $this->dirtyNote = false;
        }
    }

}
