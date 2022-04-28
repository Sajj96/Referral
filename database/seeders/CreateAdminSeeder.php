<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Super Admin
        DB::enableQueryLog();
        $super_admin = User::firstOrNew(['email'=>'admin@example.com']);
        $super_admin->name = 'Super Admin';
        $super_admin->username = 'Admin';
        $super_admin->phone = '0717000000';
        $super_admin->password = Hash::make('Admin123');
        $super_admin->country = 'tz';
        $super_admin->user_type = User::ADMIN_USER;
        $super_admin->active = User::USER_STATUS_ACTIVE;
        $super_admin->save();
        dd(DB::getQueryLog());
    }
}
