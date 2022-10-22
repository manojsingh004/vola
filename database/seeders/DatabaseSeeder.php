<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = json_decode(file_get_contents(storage_path() . "\app\public\User.json"), true);
        $userProfile = json_decode(file_get_contents(storage_path() . "\app\public\UserProfile.json"), true);


        for($i=0;$i<count($user);$i++){

            User::create([
	            'id' => $user[$i]['id'],
	            'isActive' => ($user[$i]['isActive']?1:0),

	        ]);

            UserProfile::create([
	            'userId' => $userProfile[$i]['userId'],
	            'name' => $userProfile[$i]['name'],
                'age' => $userProfile[$i]['age'],
                'city' => $userProfile[$i]['city'],

	        ]);
        }


    }
}
