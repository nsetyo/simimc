<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Categories;
use App\Models\User;
use Illuminate\Database\Seeder;

use function Psl\Dict\from_keys;
use function Psl\Dict\map;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'        => 'Administrator',
            'nrp'         => '00000',
            'occupation'  => 'Administrator Aplikasi',
            'password'    => 'secret',
            'permissions' => from_keys(
                map(Categories::cases(), fn (Categories $cat) => $cat->value),
                fn () => ['create', 'read', 'delete']
            ),
        ]);
    }
}
