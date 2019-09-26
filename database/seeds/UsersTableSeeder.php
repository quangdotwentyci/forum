<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'nhatquangprovodoi@gmail.com',
            'password' => bcrypt('nhatquang172')
        ])->each(function ($user) {
            factory(\App\Thread::class, 3)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
