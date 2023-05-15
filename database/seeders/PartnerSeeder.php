<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partner::create([
            'name' => "Mencari kedelai 1",
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora totam unde architecto voluptatem saepe recusandae possimus dignissimos deserunt quod, rerum dicta voluptatum obcaecati nobis porro, quibusdam, repellendus voluptate iste eaque repudiandae. Eius, nam? Aliquam omnis maxime dignissimos quasi eveniet, nisi minima rem. Fuga facilis non quo dignissimos earum odio voluptatibus itaque ipsa culpa eligendi maxime ullam accusamus, temporibus provident consequatur nihil tenetur, voluptatum cum sequi! Recusandae praesentium omnis aut error doloribus rerum et expedita inventore, libero voluptatum, facilis aperiam nobis sequi harum rem beatae quibusdam asperiores exercitationem ratione cupiditate quaerat consequuntur sunt officiis ipsa? Voluptatibus nulla ipsa sapiente odio autem assumenda dolore dolores, quas a maiores architecto id aut reprehenderit eveniet iste minima eum saepe placeat nisi asperiores voluptate quo error ea? Laudantium dolore perspiciatis reiciendis culpa suscipit voluptates soluta, sequi praesentium blanditiis quam quisquam rem temporibus corporis dicta modi necessitatibus porro commodi, voluptas asperiores doloribus laboriosam distinctio voluptatum officia! Vitae aliquid nobis omnis saepe dignissimos ea repellendus sequi ex corporis placeat officia nesciunt eveniet, blanditiis dolor numquam beatae quod esse. Eligendi corrupti perspiciatis sed quis itaque? Quia quasi magnam ipsam sit vitae similique eveniet reiciendis minima eos? Tempore mollitia necessitatibus doloremque provident unde reprehenderit optio maxime vero vitae? Perspiciatis.",
            'stok' => 1000,
            'price' => 7000,
            'is_active'=>true,
            'is_open'=>false,
            'bean_type' => "Kedelai hitam",
            'pengelola_id' => 1,
        ]);
        Partner::create([
            'name' => "Mencari kedelai 2",
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora totam unde architecto voluptatem saepe recusandae possimus dignissimos deserunt quod, rerum dicta voluptatum obcaecati nobis porro, quibusdam, repellendus voluptate iste eaque repudiandae. Eius, nam? Aliquam omnis maxime dignissimos quasi eveniet, nisi minima rem. Fuga facilis non quo dignissimos earum odio voluptatibus itaque ipsa culpa eligendi maxime ullam accusamus, temporibus provident consequatur nihil tenetur, voluptatum cum sequi! Recusandae praesentium omnis aut error doloribus rerum et expedita inventore, libero voluptatum, facilis aperiam nobis sequi harum rem beatae quibusdam asperiores exercitationem ratione cupiditate quaerat consequuntur sunt officiis ipsa? Voluptatibus nulla ipsa sapiente odio autem assumenda dolore dolores, quas a maiores architecto id aut reprehenderit eveniet iste minima eum saepe placeat nisi asperiores voluptate quo error ea? Laudantium dolore perspiciatis reiciendis culpa suscipit voluptates soluta, sequi praesentium blanditiis quam quisquam rem temporibus corporis dicta modi necessitatibus porro commodi, voluptas asperiores doloribus laboriosam distinctio voluptatum officia! Vitae aliquid nobis omnis saepe dignissimos ea repellendus sequi ex corporis placeat officia nesciunt eveniet, blanditiis dolor numquam beatae quod esse. Eligendi corrupti perspiciatis sed quis itaque? Quia quasi magnam ipsam sit vitae similique eveniet reiciendis minima eos? Tempore mollitia necessitatibus doloremque provident unde reprehenderit optio maxime vero vitae? Perspiciatis.",
            'stok' => 1000,
            'price' => 7000,
            'is_active'=>true,
            'is_open'=>false,
            'bean_type' => "Kedelai ungu",
            'pengelola_id' => 1,
        ]);
        Partner::factory(4)->create();
    }
}
