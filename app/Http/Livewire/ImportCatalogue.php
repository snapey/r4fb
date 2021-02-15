<?php

namespace App\Http\Livewire;

use App\Item;
use App\Providers\Csv;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportCatalogue extends Component
{
    use WithFileUploads;

    public $upload;
    public $loaded;
    public $iteration=0;

    public function render()
    {
        return view('livewire.import-catalogue');
    }

    public function updatedUpload()
    {
        $this->validate([
            'upload' => 'required|mimes:txt,csv',
        ]);

        $this->loaded=true;
    }

    public function process()
    {
        if($this->upload == null) return;

        $importCount = 0;

        $file = Storage::disk('uploads')->get('livewire-tmp/' . $this->upload->getFilename());

        $file = collect(explode(PHP_EOL,$file));

        $file->shift();  // lose the headers

        $file->each(function($row) use(&$importCount){

            $row = explode(',',$row);

            if(count($row) < 6) return;

            // might be a bug here in that if the item is unchanged then the database is not updated
            // and the updated_at timestamp remains the same.
            Item::updateOrCreate(
                [
                    'code' => $row[0]
                ],
                [
                    'description'=> $row[1],
                    'category'=> $row[2],
                    'uom' => $row[3],
                    'case_quantity' => $row[4],
                    'each' => intval(strval($row[5]*100)),
                    'generic' => false,
                    'updated_at' => now(),
                ]
            );

            $importCount++;
        });

        // $this->emit('refreshItems');

        $this->iteration++;
        $this->loaded = false;
        $this->upload = null;
        
        $this->dispatchBrowserEvent('swal', [
            'title' => 'The Catalog has been imported',
            'text'  => $importCount . ' items were updated from the CSV',
            'icon'  => 'success',
        ]);

    }

    public function extractIdentifierFromRow($row)
    {
        dd($row);
    }

    public function extractFieldsFromRow($row)
    {
        $attributes = collect($this->fieldColumnMap)
            ->filter()
            ->mapWithKeys(function ($heading, $field) use ($row) {
                return [$field => $row[$heading]];
            })
            ->toArray();

        return $attributes + ['status' => 'success', 'date_for_editing' => now()];
    }


}
