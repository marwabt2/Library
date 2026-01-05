<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $authors = [
            ['name' => 'محمود درويش'],
            ['name' => 'نجيب محفوظ'],
            ['name' => 'جبران خليل جبران'],
            ['name' => 'ويليام شكسبير'],
            ['name' => 'أجاها كريستي'],
        ];
        Author::insert($authors);
    }
}
