<?php

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
        DB::table('users')->insert([
            [
                'email'      => 'quinhatpy@gmail.com',
                'password'   => bcrypt('12345'),
                'name'      => 'Lê Quí Nhất',
                'phone'     => '0968403428',
                'address'     => 'Phú Yên',
                'avatar' => '',
                'gender' => 1,
                'birthday' => new DateTime(),
                'created_at' => new DateTime()
            ],
        ]);
    }
}
