<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        factory(App\Foodbank::class, 20)->create();
        factory(App\Address::class, 20)->create();
        factory(App\Contact::class, 20)->create();
        factory(App\Contactable::class, 30)->create();
        factory(App\Note::class, 30)->create();
        factory(App\Club::class, 30)->create();
        factory(App\Shipper::class, 13)->create();
        factory(App\Supplier::class, 14)->create();

    }
}
