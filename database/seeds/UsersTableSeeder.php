<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
        public function run()
    {
        

        $adminRole=Role::where('name','admin')->first();
        $dosenRole=Role::where('name','dosen')->first();
        $mahasiswaRole=Role::where('name','mahasiswa')->first();

        $admin=User::create([
        	'name'=>'Admin',
        	'email'=>'admin@admin.com',
        	'password'=>Hash::make('password')
        ]);
        $dosen=User::create([
        	'name'=>'Dosen',
        	'email'=>'dosen@dosen.com',
        	'password'=>Hash::make('password')
        ]);
        $mahasiwa=User::create([
        	'name'=>'User',
        	'email'=>'mahasiswa@mahasiswa.com',
        	'password'=>Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $dosen->roles()->attach($dosenRole);
        $mahasiwa->roles()->attach($mahasiswaRole);
    }
    
}
