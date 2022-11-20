<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Categories;
use App\Enums\UserAction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'        => 'Administrator',
            'nrp'         => '00000',
            'occupation'  => 'Administrator Aplikasi',
            'password'    => 'secret',
            'permissions' => array_merge(Categories::permissions(), [
                'settings::user' => [
                    UserAction::CREATE_UPDATE->value,
                    UserAction::READ->value,
                    UserAction::DELETE->value,
                ],
            ]),
        ]);
    }
}
