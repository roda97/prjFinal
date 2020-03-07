<?php

use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            //ESTG
            'country_id' => 173,
            'postal_code' => '2411 - 901',
            'city' => 'Leiria',
            'town' => 'Morro do Lena, Alto do Vieiro',
            'street' => 'Apt 4163',
            'door_number' => null,
        ]);

        DB::table('addresses')->insert([
            //ESECS
            'country_id' => 173,
            'postal_code' => '2411 - 901',
            'city' => 'Leiria',
            'town' => 'Rua Dr. João Soares',
            'street' => 'Apt 4045',
            'door_number' => null,
        ]);

        DB::table('addresses')->insert([
            //ESSLEI
            'country_id' => 173,
            'postal_code' => '2411 - 901',
            'city' => 'Leiria',
            'town' => 'Morro do Lena, Alto do Vieiro',
            'street' => 'Apt 4137',
            'door_number' => null,
        ]);

        DB::table('addresses')->insert([
            //UED
            'country_id' => 173,
            'postal_code' => '2411 - 901',
            'city' => 'Leiria',
            'town' => 'Morro do Lena, Alto do Vieiro',
            'street' => 'Apt 4163',
            'door_number' => null,
        ]);

        DB::table('addresses')->insert([
            //ESAD.CR
            'country_id' => 173,
            'postal_code' => '2500 - 321',
            'city' => 'Caldas da Rainha',
            'town' => null,
            'street' => 'Rua Isidoro Inácio Alves de Carvalho',
            'door_number' => null,
        ]);

        DB::table('addresses')->insert([
            //ESTM
            'country_id' => 173,
            'postal_code' => '2520 - 641',
            'city' => 'Peniche',
            'town' => 'Santuário de Nossa Senhora dos Remédios',
            'street' => null,
            'door_number' => null,
        ]);

        DB::table('addresses')->insert([
            //UNID. INVESTIGAÇÃO
            'country_id' => 173,
            'postal_code' => null,
            'city' => null,
            'town' => null,
            'street' => null,
            'door_number' => null,
        ]);

        DB::table('addresses')->insert([
            //IPLEIRIA R. Gen. Norton de Matos, 2411-901 Leiria
            'country_id' => 173,
            'postal_code' => '2411 - 901',
            'city' => 'Leiria',
            'town' => null,
            'street' => 'R. Gen. Norton de Matos',
            'door_number' => null,
        ]);

        DB::table('addresses')->insert([
            //SAS
            'country_id' => 173,
            'postal_code' => '2411 - 901',
            'city' => 'Leiria',
            'town' => null,
            'street' => 'R. Gen. Norton de Matos',
            'door_number' => null,
        ]);
    }
}
