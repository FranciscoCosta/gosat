<?php

use Illuminate\Database\Seeder;
use App\Models\Offer;

class personalCpf extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offer::create([
            'cpf' => '98798798798',
            'institution' => 'Example Institution',
            'institution_id' => 1,
            'name_modal' => 'Example Modal',
            'cod' => 'ABC123',
            'PMax' => 12,
            'PMin' => 6,
            'PMedium' => 7,
            'VMin' => 20000,
            'VMax' => 50000,
            'VMedium' => 325,
            'TaxesMonth' => 0.1234,
        ]);

        // You can add more sample data here
    }
}
