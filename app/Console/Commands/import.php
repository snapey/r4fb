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
            $this->info($row->clubname);

            $club = Club::create(['name'=>$row->clubname, 'district'=>'1220']);

            if($row->contact1) {
                $contact1 = Contact::create([
                    'forenames' => $this->splitName($row->contact1)[1],
                    'surname' => $this->splitName($row->contact1)[0],
                    'phone1' => $row->tele1,
                    'email1' => $row->email1,
                ]);
                $club->contacts()->attach($contact1);
            }

            if ($row->contact2) {
                $contact2 = Contact::create([
                    'forenames' => $this->splitName($row->contact2)[1],
                    'surname' => $this->splitName($row->contact2)[0],
                    'phone1' => $row->tele2,
                    'email1' => $row->email2,
                ]);
                $club->contacts()->attach($contact2);
            }

            if(!empty($row->fbname)) {

                $foodbank = Foodbank::create([
                    'name' => $row->fbname,
                    'name2' => $row->fbname2,
                    'phone1' => $row->fbtele1,
                    'website' => $row->website,
                    'email' => $row->fbemail1,
                ]);
                
                $club->foodbanks()->attach($foodbank);

                if($row->postcode) {
                    $address = Address::create([
                        'address1' => $row->address1 ?? $row->address2, 
                        'address2' => $row->address2,
                        'address3' => $row->town,
                        'address4' => $row->county,
                        'postcode' => $row->postcode,
                        'addressable_id' => $foodbank->id,
                        'addressable_type' => 'App\Foodbank'
                    ]);
                }

                //foodbank contacts
                if(!empty($row->fbcontact1)){

                    $contact1 = Contact::create([
                        'forenames' => $this->splitName($row->fbcontact1)[1],
                        'surname' => $this->splitName($row->fbcontact1)[0],
                        'phone1' => $row->fbtele1,
                        'email1' => $row->fbemail1,
                    ]);

                    $foodbank->contacts()->attach($contact1);
                }

                if (!empty($row->fbcontact2)) {

                    $contact2 = Contact::create([
                        'forenames' => $this->splitName($row->fbcontact2)[1],
                        'surname' => $this->splitName($row->fbcontact2)[0],
                        'phone1' => $row->fbtele2,
                        'email1' => $row->fbemail2,
                    ]);

                    $foodbank->contacts()->attach($contact2);
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
