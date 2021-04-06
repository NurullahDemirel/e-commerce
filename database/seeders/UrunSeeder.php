<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Seeder;
use App\Models\UrunModel;
use App\Models\DetayModel;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class UrunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();
        UrunModel::truncate();
        DetayModel::truncate();

        for ($i=0;$i<31;$i++){
            $urun_adi=$faker->sentence(2);
            $urun=UrunModel::create([

                'urun_adi'=>$urun_adi,
                'slug'=>Str::slug($urun_adi),
                'aciklama'=>$faker->sentence(5),
                'fiyati'=>$faker->randomFloat(3,1,20),
            ]);
            $detay=$urun->detay()->create([
                'goster_slide'=>rand(0,1),
                'gunun_firsati'=>rand(0,1),
                'one_cikan'=>rand(0,1),
                'cok_satan'=>rand(0,1),
                'indirimli'=>rand(0,1),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
