<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $users = [
            [
                'title' => 'Mr',
                'name' => 'Matthew Yeend',
                'slug' => Str::slug('Matthew Yeend'),
                'email' => 'superadmin@example.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password'),
                'role' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $extraUsers = [
            ['Miss', 'Emma', 'Wilson', 'emma.wilson@example.com', 2],
            ['Mr', 'Liam', 'Johnson', 'liam.johnson@example.com', 3],
            ['Mrs', 'Sophia', 'Turner', 'sophia.turner@example.com', 3],
            ['Ms', 'Olivia', 'Green', 'olivia.green@example.com', 3],
            ['Mr', 'Noah', 'Walker', 'noah.walker@example.com', 3],
            ['Mrs', 'Ava', 'Martin', 'ava.martin@example.com', 3,],
            ['Mr', 'William', 'King', 'william.king@example.com', 3],
            ['Miss', 'Isabella', 'Scott', 'isabella.scott@example.com', 2],
            ['Mr', 'James', 'White', 'james.white@example.com', 3],
            ['Miss', 'Mia', 'Baker', 'mia.baker@example.com', 3],
            ['Mr', 'Lucas', 'Reed', 'lucas.reed@example.com', 2],
            ['Mrs', 'Amelia', 'Wright', 'amelia.wright@example.com', 3],
        ];

        foreach ($extraUsers as $index => [$title, $first, $last, $email, $roleId]) {
            $users[] = [
                'title' => $title,
                'name' => "$first $last",
                'slug' => Str::slug("$first $last"),
                'email' => $email,
                'email_verified_at' => $now,
                'password' => Hash::make('password'),
                'role' => $roleId,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        User::insert($users);
    }
}
