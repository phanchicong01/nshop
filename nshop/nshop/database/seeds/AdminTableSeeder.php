<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            [
                'email'      => 'quinhatpy@gmail.com',
                'password'   => bcrypt('12345'),
                'name'      => 'Lê Quí Nhất',
                'phone'     => '0968403428',
                'address'     => 'Phú Yên',
                'level'      => 1,
                'avatar' => '',
                'gender' => 1,
                'birthday' => new DateTime(),
                'created_at' => new DateTime()
            ],
        ]);
    }
}
