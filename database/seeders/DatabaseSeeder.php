<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 3 types of users
        User::create([
            'name' => 'Admin Ngawi',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pegawai Perpustakaan',
            'email' => 'pegawai@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
        ]);

        User::create([
            'name' => 'Siswa Jomok',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pengunjung',
        ]);

        // Create Categories with Rules
        $cat1 = Category::create(['name' => 'Buku Pelajaran', 'fine_per_day' => 2000, 'loan_duration_days' => 14]);
        $cat2 = Category::create(['name' => 'Fiksi', 'fine_per_day' => 1000, 'loan_duration_days' => 7]);
        $cat3 = Category::create(['name' => 'Ensiklopedia', 'fine_per_day' => 5000, 'loan_duration_days' => 3]);

        // Create Authors
        $auth1 = Author::create(['name' => 'Ki Hajar Dewantara', 'bio' => 'Bapak Pendidikan Indonesia.']);
        $auth2 = Author::create(['name' => 'Tere Liye', 'bio' => 'Penulis novel terkenal.']);

        // Create Books
        Book::create([
            'title' => 'Pendidikan Nasional',
            'author_id' => $auth1->id,
            'category_id' => $cat1->id,
            'isbn' => '978-602-123',
            'stock' => 50,
            'description' => 'Buku tentang sejarah pendidikan di Indonesia.'
        ]);

        Book::create([
            'title' => 'Bumi',
            'author_id' => $auth2->id,
            'category_id' => $cat2->id,
            'isbn' => '978-602-456',
            'stock' => 20,
            'description' => 'Petualangan dunia paralel.'
        ]);
    }
}
