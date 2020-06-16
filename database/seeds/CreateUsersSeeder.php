<?php
  
use Illuminate\Database\Seeder;
use App\User;
   
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Admin',
               'email'=>'admin@itsolutionstuff.com',
                'is_admin'=>'true',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User',
               'email'=>'user@itsolutionstuff.com',
                'is_admin'=>'false',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        // foreach ($user as $key => $value) {
        //     User::create($value);
        // }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}