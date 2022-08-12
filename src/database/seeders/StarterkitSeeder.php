<?php

namespace Laililmahfud\Starterkit\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laililmahfud\Starterkit\Models\CmsPrivileges;
use Laililmahfud\Starterkit\Models\CmsUsers;

class StarterkitSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        self::seedCmsUser();
    }

    private static function seedCmsUser()
    {
        $privileges = CmsPrivileges::where('is_superadmin', 1)->first();
        if (!$privileges) {
            $privileges = CmsPrivileges::create([
                'name' => 'Super Administrator',
                'is_superadmin' => 1,
            ]);
        }
        if (!CmsUsers::where('email', 'admin@starterkit.com')->first()) {
            CmsUsers::create([
                'name' => 'Administrator',
                'email' => 'admin@starterkit.com',
                'password' => Hash::make('12345678'),
                'cms_privileges_id' => $privileges->id,
                'status' => 'active',
                'profile' => 'vendor/starterkit/img/avatar-2.jpg',
            ]);
        }
    }
}
