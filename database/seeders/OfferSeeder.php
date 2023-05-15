<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offer::create([
            "name"=>"Penawaran 1",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex optio eveniet similique, eos suscipit ipsam quia accusantium nostrum animi hic excepturi rem alias adipisci ab dolores, error non distinctio. Adipisci aspernatur delectus cupiditate possimus assumenda? Fugit non labore distinctio ratione perferendis commodi natus fugiat laborum nam nesciunt ducimus debitis architecto, exercitationem odit voluptatem. Inventore laboriosam, soluta et temporibus sit aut. Commodi sapiente ut neque accusantium, perferendis quasi deleniti temporibus nostrum ea voluptate nam atque quaerat consequuntur reprehenderit harum odit error iste eveniet quo sint fugiat! Nulla labore hic asperiores dignissimos nobis facere, unde porro perspiciatis saepe commodi velit perferendis consequuntur deleniti amet inventore sint expedita ex qui necessitatibus delectus magnam similique ipsum. Voluptatum beatae esse assumenda. Iste suscipit quis harum explicabo dolores deserunt dicta officia minus, placeat iure dolore doloribus deleniti voluptatum magni quibusdam. Soluta dolore quisquam eaque nam expedita, sed ipsa reiciendis ipsum ab exercitationem, fugit ut, id laudantium unde accusamus corporis? Voluptates odit quod molestiae distinctio, deleniti itaque consectetur dolorem quas tempore ad facere asperiores, repudiandae culpa illo deserunt iste accusantium, officiis quae similique ipsum hic officia nesciunt? Quam qui officiis, cum, expedita minus nulla perferendis assumenda maiores rem vel animi facere, alias illo nam? Ullam, eligendi cumque!",
            "stok" => 1000,
            "price" => 7000,
            "bean_id" => 1,
            "petani_id"  => 3,
        ]);

        Offer::create([
            "name"=>"Penawaran 2",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex optio eveniet similique, eos suscipit ipsam quia accusantium nostrum animi hic excepturi rem alias adipisci ab dolores, error non distinctio. Adipisci aspernatur delectus cupiditate possimus assumenda? Fugit non labore distinctio ratione perferendis commodi natus fugiat laborum nam nesciunt ducimus debitis architecto, exercitationem odit voluptatem. Inventore laboriosam, soluta et temporibus sit aut. Commodi sapiente ut neque accusantium, perferendis quasi deleniti temporibus nostrum ea voluptate nam atque quaerat consequuntur reprehenderit harum odit error iste eveniet quo sint fugiat! Nulla labore hic asperiores dignissimos nobis facere, unde porro perspiciatis saepe commodi velit perferendis consequuntur deleniti amet inventore sint expedita ex qui necessitatibus delectus magnam similique ipsum. Voluptatum beatae esse assumenda. Iste suscipit quis harum explicabo dolores deserunt dicta officia minus, placeat iure dolore doloribus deleniti voluptatum magni quibusdam. Soluta dolore quisquam eaque nam expedita, sed ipsa reiciendis ipsum ab exercitationem, fugit ut, id laudantium unde accusamus corporis? Voluptates odit quod molestiae distinctio, deleniti itaque consectetur dolorem quas tempore ad facere asperiores, repudiandae culpa illo deserunt iste accusantium, officiis quae similique ipsum hic officia nesciunt? Quam qui officiis, cum, expedita minus nulla perferendis assumenda maiores rem vel animi facere, alias illo nam? Ullam, eligendi cumque!",
            "stok" => 1000,
            "price" => 7000,
            "bean_id" => 2,
            "petani_id"  => 3,
        ]);
    }
}
