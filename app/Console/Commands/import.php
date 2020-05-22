<?php

namespace App\Console\Commands;

use App\Address;
use App\Club;
use App\Contact;
use App\Foodbank;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'convert from imports table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //convert the import table into clubs, foodbanks, contacts and addresses
        // all data on one record.

        $rows = DB::table('import')->get();

        $rows->each(function($row){
            $this->info($row->fbname);

            $foodbank = Foodbank::create([
                'name' => $row->fbname,
                'organisation' => $row->organisation,
                'phone1' => $row->fbtele1,
                'phone2' => $row->fbtele2,
                'website' => $row->website,
                'email' => $row->fbemail1,
                'charity' => $row->fbcharity,
                'facebook' => $row->fbfacebook,
            ]);

            if ($row->postcode) {
                $address = Address::create([
                    'address1' => $row->address1 ?? $row->address2,
                    'address2' => $row->address2,
                    'address3' => $row->address3,
                    'address4' => $row->address4 . ', ' . $row->address5,
                    'postcode' => $row->postcode,
                    'addressable_id' => $foodbank->id,
                    'addressable_type' => 'App\Foodbank'
                ]);
            }

            if ($row->fbcontact1) {
                $fbc1 = Contact::create([
                    'forenames' => $this->splitName($row->fbcontact1)[1],
                    'surname' => $this->splitName($row->fbcontact1)[0],
                    // 'phone1' => $row->tele1,
                    // 'email1' => $row->email1,
                ]);
                $foodbank->contacts()->attach($fbc1, ['relationship' => $row->fbposition]);
            }

            if($row->clubname) {
                $club = Club::create(['name'=>$row->clubname]);
            
                $foodbank->clubs()->attach($club);

                if ($row->contact1) {
                    $contact1 = Contact::create([
                        'forenames' => $this->splitName($row->contact1)[1],
                        'surname' => $this->splitName($row->contact1)[0],
                        'phone1' => $row->tele1,
                        'email1' => $row->email1,
                    ]);
                    $club->contacts()->attach($contact1);
                }
            }
        });
    }

    /**
     * splits a name into forenames and surname
     * returns as an array, [surname,forenames]
     * does not work with foreign names like 'Tony De la Hunty'
     *
     * @param string $name
     * @return array
     */
    public function splitName($name=''):array
    {
        if($name=='') return ['',''];

        $names = explode(' ', trim($name));
        $lastname = $names[count($names) - 1];
        unset($names[count($names) - 1]);
        $firstname = join(' ', $names);
        return [$lastname,$firstname];
    }
}
