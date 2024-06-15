<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\Athlete;
use App\Models\Admin\Club;
use App\Models\Admin\Modality;
use App\Models\Admin\Referee;
use App\Models\Admin\Role;
use App\Models\Admin\Scorer;
use App\Models\User;
use Illuminate\Database\Seeder;
use UserTableSeeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //criação dos papeis de usuario
        Role::create([
            'id'            => 1,
            'name'          => 'Super Administrador',
            'description'   => 'Acesso completo a aplicação',
        ]);

        Role::create([
            'id'            => 2,
            'name'          => 'Administrador',
            'description'   => 'Acesso completo a modalidade',
        ]);

        Role::create([
            'id'            => 3,
            'name'          => 'Usuario',
            'description'   => 'Acesso somente aos seus proprios dados',
        ]);


        //criação das modalidades
        Modality::create([
            'name'      => 'Hoquei Tradicional',
            'logo' => '',
        ]);

        Modality::create([
            'name'      => 'Hoquei Inline',
            'logo' => '',
        ]);


        //Usuarios
        User::create([
            'name'              => 'Rodrigo Caldas',
            'email'             => 'rodrigo@vaptfotos.com.br',
            'password'          => bcrypt('q1w2e3r4Q!W@E#R$'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'image'             => '',
            'role_id'           => '1',
        ]);


        //criação das Times
        $club_a = Club::create([
            'name'      => 'Ceara Sporting Club',
            'image' => '',
        ]);

        $club_a->modalities()->attach(1);

        $club_b = Club::create([
            'name'      => 'Fortaleza Esporte Clube',
            'image' => '',
        ]);
        $club_b->modalities()->attach(1);

        $faker = Faker::create();
        //Adicionando Arbitro
        foreach (range(1, 10) as $index) {
            Referee::create([
                'name' => $faker->name,
                'birthday' => $faker->dateTimeBetween($startDate = '-50 years', $endDate = '-30 years'),
                'email' => $faker->unique()->safeEmail
            ]);
        }

        //Adicionando Mesario
        foreach (range(1, 10) as $index) {
            Scorer::create([
                'name' => $faker->name,
                'birthday' => $faker->dateTimeBetween($startDate = '-50 years', $endDate = '-30 years'),
                'email' => $faker->unique()->safeEmail
            ]);
        }

        //Adicionando Atleta
        foreach (range(1, 20) as $index) {
            Athlete::create([
                'name' => $faker->name,
                'birthday' => $faker->dateTimeBetween($startDate = '-40 years', $endDate = '-10 years'),
                'email' => $faker->unique()->safeEmail,
                'club_id' => 1
            ]);
        }
        foreach (range(1, 20) as $index) {
            Athlete::create([
                'name' => $faker->name,
                'birthday' => $faker->dateTimeBetween($startDate = '-40 years', $endDate = '-10 years'),
                'email' => $faker->unique()->safeEmail,
                'club_id' => 2
            ]);
        }

    }
}
