<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataUser extends Seeder
{
    public function run()
    {
        $data = [
            [
              
                'nama'      => 'Rizki',
                'username'  => 'rizki',
                'password'  =>'rizki1',
                'alamat'    => 'Jl. Merdeka',
                'email'     => 'rizki@gmail.com',
                'no_hp'     => '08123456789',
                'role'      => 'Klien',
            ],
            [
                'id_user'   => 2,
                'nama'      => 'Budi',
                'username'  => 'budi',
                'password'  => 'budi2',
                'alamat'    => 'Jl. Raya 2',
                'email'     => 'budi@gmail.com',
                'no_hp'     => '08198765432',
                'role'      => 'Klien',
            ],
            [
                
                'nama'      => 'Siti',
                'username'  => 'siti',
                'password'  => 'siti3',
                'alamat'    => 'JL. Pahlawan',
                'email'     => 'siti@gmail.com',
                'no_hp'     => '08234567890',
                'role'      => 'Klien',
            ],
            [
                
                'nama'      => 'Ali',
                'username'  => 'ali1',
                'password'  => 'ali',
                'alamat'    => 'Jl. Pembangunan',
                'email'     => 'ali@gmail.com',
                'no_hp'     => '081254668722',
                'role'      => 'Teknisi',
            ],
            [
           
                'nama'      => 'Angga',
                'username'  => 'angga2',
                'password'  =>'angga',
                'alamat'    => 'Jl. Dr. Mansyur',
                'email'     => 'angga@gmail.com',
                'no_hp'     => '082618472618',
                'role'      => 'Teknisi',
            ],
            [
                
                'nama'      => 'Zaki',
                'username'  => 'Zaki3',
                'password'  => 'zaki',
                'alamat'    => 'Jl. Sudirman',
                'email'     => 'zaki@gmail.com',
                'no_hp'     => '082649164837',
                'role'      => 'Teknisi',
            ],
            [
          
                'nama'      => 'Joni',
                'username'  => 'joni_surveyor1',
                'password'  => 'joni',
                'alamat'    => 'Jl. Mangga',
                'email'     => 'joni@gmail.com',
                'no_hp'     => '081273937382',
                'role'      => 'Surveyor',
            ],
            [
             
                'nama'      => 'Mahmud',
                'username'  => 'mahmud_surveyor2',
                'password'  => 'mahmud',
                'alamat'    => 'Jl. Suka Jati',
                'email'     => 'mahmud@gmail.com',
                'no_hp'     => '081364738293',
                'role'      => 'Surveyor',
            ],
            [
                
                'nama'      => 'Mursid',
                'username'  => 'mursid_surveyor3',
                'password'  => 'mursid', 
                'alamat'    => 'JL. Imam Bonjol',
                'email'     => 'mursid@gmail.com',
                'no_hp'     => '081364739283',
                'role'      => 'Surveyor',
            ],
            [
               
                'nama'      => 'Hakim',
                'username'  => 'hakim_admin1',
                'password'  => 'hakim',
                'alamat'    => 'Jl. Admin 1',
                'email'     => 'hakim@gmail.com',
                'no_hp'     => '081264928373',
                'role'      => 'Admin',
            ],
            [
                
                'nama'      => 'Lingga',
                'username'  => 'lingga_admin2',
                'password'  => 'lingga', 
                'alamat'    => 'Jl. Admin 2',
                'email'     => 'lingga@gmail.com',
                'no_hp'     => '081247362949',
                'role'      => 'Admin',
            ],
            [
              
                'nama'      => 'Tukul',
                'username'  => 'tukul_admin3',
                'password'  => 'tukul',
                'alamat'    => 'Jl. Admin 3',
                'email'     => 'tukul@gmail.com',
                'no_hp'     => '086732742847',
                'role'      => 'Admin',
            ],
        ];

        // Insert data ke tabel users
        foreach ($data as $user) {
            $this->db->table('users')->insert($user);
        }
    }
}
