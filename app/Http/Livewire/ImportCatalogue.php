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


        try {
            $file->each(function($row) use(&$importCount){

                $row = explode(',',$row);

                if(count($row) < 6) return;

                if($row[0] == "") return;

                $item = Item::firstOrNew([
                        'code' => $row[0]
                    ]);

                // $item->fill([
                //     'description' => $row[1],
                //     'category' => $row[2],
                //     'uom' => $row[3],
                //     'case_quantity' => $row[4],
                //     'net' => intval(strval($row[5] * 100)),
                //     'generic' => false,
                //     'updated_at' => now(),
                // ]);

                $item->fill([
                    'description' => $row[1],
                    'uom' => $row[2],
                    'case_quantity' => $row[3],
                    'net' => intval(strval($row[4] * 100)),
                    'generic' => false,
                    'updated_at' => now(),
                ]);


                $item->each = $item->net * (100+$item->vatrate)/100;

                $item->save();

                $importCount++;
            });

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('swal', [
                'text' => 'There was a problem with the catalog import on line ' . $importCount,
                'title' => 'Import Failed',
                'icon'  => 'warning',
            ]);
            $this->loaded = false;
            $this->upload = null;

            return;
        }
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
