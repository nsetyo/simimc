<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'       => 'Administrator',
            'email'      => 'admin@simc.tni-au.go.id',
            'nrp'        => '00000',
            'occupation' => 'Administrator Aplikasi',
            'password'   => Hash::make('secret'),
        ]);
    }
}
