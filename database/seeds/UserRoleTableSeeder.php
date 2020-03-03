<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('user_role')->delete();

        $users = [
            [
                'id' => 1,
                'first_name' => 'Thain',
                'last_name' => 'Breese',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ],
            [
                'id' => 2,
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'user@example.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        ];
        App\User::insert($users);

        $roles = [
            [
                'id' => 1,
                'name' => 'user',
            ],
            [
                'id' => 2,
                'name' => 'admin',
            ]
        ];
        App\Role::insert($roles);

        $user_roles = [
            [
                'user_id' => 1,
                'role_id' => 2,
            ],
            [
                'user_id' => 2,
                'role_id' => 1,
            ],
        ];

        DB::table('user_role')->insert($user_roles);
    }
}
