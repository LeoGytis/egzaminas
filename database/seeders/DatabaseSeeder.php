<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // ========================== Restaurant ==========================

        $restaurant_names = ['Berneliu uzeiga', 'Juodas Vilkas', 'Balta Avele', 'Cepelinai Tau', 'Katmandu', 'Cili pica', 'Pienine', 'Bistro', 'Kultura'];

        foreach (range(1, 10) as $_) {
            DB::table('restaurants')->insert([
                'name' => $restaurant_names[rand(0, count($restaurant_names) - 1)],
                'code' => $faker->postcode,
                'address' => $faker->address,
            ]);
        }
        
        // ========================== Menu ==========================
        $menu_names = ['Pusryciu meniu', 'Pietu meniu', 'Vakarienes meniu', 'Turisto meniu', 'A la carte', 'Vaiku meniu', 'Slaptasis', 'Pirato grobis', 'Alkanas nebusi'];

        foreach (range(1, 20) as $_) {
            DB::table('menus')->insert([
                'name' => $menu_names[rand(0, count($menu_names) - 1)],
                'restaurant_id' => rand(1, 10),
            ]);
        }

        // // ========================== Dishes ==========================
        foreach (range(1, 30) as $_) {
            $dishes_list = ['Cepelinai', 'Blynai', 'Pica', 'Karbonadatas', 'Pyragas', 'Ledai', 'Makaronai', 'Kepsnys', 'Saslykas', 'Koldunai', 'Ledu kokteilis'];
            $dish_description = 'Labai skanus patiekalas. Prašom paragauti';
            $photopath = 'http://localhost/egzaminas/public/images/dishes/';

            DB::table('dishes')->insert([
                'name' => $dishes_list[rand(0, count($dishes_list) - 1)],
                'description' => $dish_description,
                // 'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'photo' => $photopath . rand(1, 10) . '.jpg',
                'menu_id' => rand(1, 10),
            ]);
        }

        // ========================== USERS ==========================
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'role' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 10,
        ]);

        DB::table('users')->insert([
            'name' => 'Gytis',
            'email' => 'leogytis@gmail.com',
            'password' => Hash::make('123'),
            'role' => 10,
        ]);
    }
}
