<?php

namespace Database\Seeders;

use App\Enums\Ask;
use App\Enums\Gender;
use App\Models\User;
use App\Enums\Status;
use App\Models\Address;
use App\Enums\Role as EnumRole;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $envService = new EnvEditor();

        $admin      = User::create([
            'first_name'        => 'John',
            'last_name'         => 'Doe',
            'email'             => 'admin@example.com',
            'phone'             => '1254875855',
//            'username'          => 'admin',
            'points'            => 2000,
            'birthday'          => '2001-01-01',
            'gender'            => Gender::MALE,
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'status'            => Status::ACTIVE,
            'country_code'      => '+880',
            'is_guest'          => Ask::NO
        ]);
        $admin->assignRole(EnumRole::ADMIN);
        if ($envService->getValue('DEMO')) {
            Address::create([
                'full_name'    => $admin->first_name . ' ' . $admin->last_name,
                'email'        => $admin->email,
                'country_code' => $admin->country_code,
                'phone'        => $admin->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1209',
                'address'      => 'House :20, Road: 19, Block: B, Dhanmondi 32',
                'user_id'      => $admin->id,
            ]);
            Address::create([
                'full_name'    => $admin->first_name . ' ' . $admin->last_name,
                'email'        => $admin->email,
                'country_code' => $admin->country_code,
                'phone'        => $admin->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1216',
                'address'      => 'House :31, Road: 9, Block: A, Mirpur 1',
                'user_id'      => $admin->id,
            ]);
        }

        $customer = User::create([
            'first_name'        => 'Walking',
            'last_name'         => 'Customer',
            'birthday'          => '2001-01-01',
            'gender'            => Gender::MALE,
            'points'            => 5000,
            'email'             => 'walkingcustomer@example.com',
            'phone'             => '125444455',
//            'username'          => 'default-customer',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'status'            => Status::ACTIVE,
            'country_code'      => '+880',
            'is_guest'          => Ask::NO
        ]);
        $customer->assignRole(EnumRole::CUSTOMER);
        if ($envService->getValue('DEMO')) {
            Address::create([
                'full_name'    => $customer->first_name . ' ' . $customer->last_name,
                'email'        => $customer->email,
                'country_code' => $customer->country_code,
                'phone'        => $customer->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1216',
                'address'      => 'House :3, Road: 11, Block: A, Mirpur 12',
                'user_id'      => $customer->id,
            ]);
        }

        if ($envService->getValue('DEMO')) {
            $customerOne = User::create([
                'first_name'        => 'Will',
                'last_name'         => 'Smith',
                'birthday'          => '2001-01-01',
                'gender'            => Gender::MALE,
                'email'             => 'customer@example.com',
                'phone'             => '125333344',
                'points'            => 2500,
//                'username'          => 'will-smith',
                'email_verified_at' => now(),
                'password'          => bcrypt('123456'),
                'status'            => Status::ACTIVE,
                'country_code'      => '+880',
                'is_guest'          => Ask::NO
            ]);
            $customerOne->assignRole(EnumRole::CUSTOMER);
            Address::create([
                'full_name'    => $customerOne->first_name . ' ' . $customerOne->last_name,
                'email'        => $customerOne->email,
                'country_code' => $customerOne->country_code,
                'phone'        => $customerOne->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1216',
                'address'      => 'House :3, Road: 1, Block: C, Mirpur 2',
                'user_id'      => $customerOne->id,
            ]);
            Address::create([
                'full_name'    => $customerOne->first_name . ' ' . $customerOne->last_name,
                'email'        => $customerOne->email,
                'country_code' => $customerOne->country_code,
                'phone'        => $customerOne->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1209',
                'address'      => 'House :30, Road: 13, Block: A, Dhanmondi 32',
                'user_id'      => $customerOne->id,
            ]);

            $employeeOne = User::create([
                'first_name'        => 'Kiron',
                'last_name'         => 'Khan',
                'birthday'          => '2001-01-01',
                'gender'            => Gender::MALE,
                'email'             => 'manager@example.com',
                'phone'             => '1275333453',
                'points'            => 1995,
//                'username'          => 'kiron-khan1313',
                'email_verified_at' => now(),
                'password'          => bcrypt('123456'),
                'status'            => Status::ACTIVE,
                'country_code'      => '+880',
                'is_guest'          => Ask::NO
            ]);
            $employeeOne->assignRole(EnumRole::MANAGER);
            Address::create([
                'full_name'    => $employeeOne->first_name . ' ' . $employeeOne->last_name,
                'email'        => $employeeOne->email,
                'country_code' => $employeeOne->country_code,
                'phone'        => $employeeOne->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1209',
                'address'      => 'House :10, Road: 5, Block: A, Dhanmondi 32',
                'user_id'      => $employeeOne->id,
            ]);

            $employeeTwo = User::create([
                'first_name'        => 'Shohag',
                'last_name'         => 'Ali',
                'birthday'          => '2001-01-01',
                'gender'            => Gender::MALE,
                'points'            => 10000,
                'email'             => 'shohag@example.com',
                'phone'             => '1257654433',
//                'username'          => 'shohag-ali3324',
                'email_verified_at' => now(),
                'password'          => bcrypt('123456'),
                'status'            => Status::ACTIVE,
                'country_code'      => '+880',
                'is_guest'          => Ask::NO
            ]);
            $employeeTwo->assignRole(EnumRole::MANAGER);
            Address::create([
                'full_name'    => $employeeTwo->first_name . ' ' . $employeeTwo->last_name,
                'email'        => $employeeTwo->email,
                'country_code' => $employeeTwo->country_code,
                'phone'        => $employeeTwo->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1216',
                'address'      => 'House :30, Road: 4, Block: D, Mirpur 11',
                'user_id'      => $employeeTwo->id,
            ]);

            $posOperatorOne = User::create([
                'first_name'        => 'Farha',
                'last_name'         => 'Israt',
                'birthday'          => '2001-01-01',
                'gender'            => Gender::FEMALE,
                'email'             => 'posoperator@example.com',
                'phone'             => '156873641',
                'points'            => 20000,
//                'username'          => 'farha-istat343',
                'email_verified_at' => now(),
                'password'          => bcrypt('123456'),
                'status'            => Status::ACTIVE,
                'country_code'      => '+880',
                'is_guest'          => Ask::NO
            ]);
            $posOperatorOne->assignRole(EnumRole::POS_OPERATOR);
            Address::create([
                'full_name'    => $posOperatorOne->first_name . ' ' . $posOperatorOne->last_name,
                'email'        => $posOperatorOne->email,
                'country_code' => $posOperatorOne->country_code,
                'phone'        => $posOperatorOne->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1209',
                'address'      => 'House :30, Road: 4, Block: D, Dhanmondi 11',
                'user_id'      => $posOperatorOne->id,
            ]);

            $posOperatorTwo = User::create([
                'first_name'        => 'Sahataz',
                'last_name'         => 'Afnan',
                'birthday'          => '2001-01-01',
                'gender'            => Gender::MALE,
                'email'             => 'sahataz@example.com',
                'phone'             => '1249955570',
                'points'            => 12000,
//                'username'          => 'sahataz-afnan232',
                'email_verified_at' => now(),
                'password'          => bcrypt('123456'),
                'status'            => Status::ACTIVE,
                'country_code'      => '+880',
                'is_guest'          => Ask::NO
            ]);
            $posOperatorTwo->assignRole(EnumRole::POS_OPERATOR);
            Address::create([
                'full_name'    => $posOperatorTwo->first_name . ' ' . $posOperatorTwo->last_name,
                'email'        => $posOperatorTwo->email,
                'country_code' => $posOperatorTwo->country_code,
                'phone'        => $posOperatorTwo->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1216',
                'address'      => 'House :10, Road: 2, Block: C, Mirpur 14',
                'user_id'      => $posOperatorTwo->id,
            ]);

            $stuffOne = User::create([
                'first_name'        => 'Rohim',
                'last_name'         => 'Miya',
                'birthday'          => '2001-01-01',
                'gender'            => Gender::FEMALE,
                'points'            => 52000,
                'email'             => 'stuff@example.com',
                'phone'             => '1222224443',
//                'username'          => 'rohim-miya768',
                'email_verified_at' => now(),
                'password'          => bcrypt('123456'),
                'status'            => Status::ACTIVE,
                'country_code'      => '+880',
                'is_guest'          => Ask::NO
            ]);
            $stuffOne->assignRole(EnumRole::STUFF);
            Address::create([
                'full_name'    => $stuffOne->first_name . ' ' . $stuffOne->last_name,
                'email'        => $stuffOne->email,
                'country_code' => $stuffOne->country_code,
                'phone'        => $stuffOne->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1216',
                'address'      => 'House :11, Road: 12, Block: C, Mirpur 6',
                'user_id'      => $stuffOne->id,
            ]);

            $stuffTwo = User::create([
                'first_name'        => 'Kala',
                'last_name'         => 'Chan',
                'birthday'          => '2001-01-01',
                'gender'            => Gender::FEMALE,
                'email'             => 'kala@example.com',
                'phone'             => '1238426043',
                'points'            => 42000,
//                'username'          => 'kala-chan890',
                'email_verified_at' => now(),
                'password'          => bcrypt('123456'),
                'status'            => Status::ACTIVE,
                'country_code'      => '+880',
                'is_guest'          => Ask::NO
            ]);
            $stuffTwo->assignRole(EnumRole::STUFF);
            Address::create([
                'full_name'    => $stuffTwo->first_name . ' ' . $stuffTwo->last_name,
                'email'        => $stuffTwo->email,
                'country_code' => $stuffTwo->country_code,
                'phone'        => $stuffTwo->phone,
                'country'      => "Bangladesh",
                'state'        => 'Dhaka District',
                'city'         => 'Dhaka',
                'zip_code'     => '1209',
                'address'      => 'House :1, Road: 2, Block: A, Dhanmondi 27',
                'user_id'      => $stuffTwo->id,
            ]);
        }
    }
}
