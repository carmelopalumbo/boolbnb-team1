<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $users = config('db.users');

        foreach ($users as $user) {
            $new_user = new User();
            $new_user->name = $user['name'];
            $new_user->lastname = $user['lastname'];
            $new_user->username = $user['username'];
            $new_user->email = $user['email'];
            $new_user->password = bcrypt($user['password']);
            $new_user->date_of_birth = $user['date_of_birth'];

            //dump($new_user);
            $new_user->save();
        }
    }
}
