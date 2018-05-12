<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        if(count($users) < 1){
            User::create([
            'name' => 'MDW',
                'email' => 'info@mekong.digital',
                'password' => bcrypt('mdw@)!&digital'),
            ]);
        }
        
    }
}
