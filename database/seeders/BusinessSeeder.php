<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Seeder;


class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::factory()
            ->count(20)
            // ->hasUsers(10)
            ->has(
                User::factory()
                    ->count(10)
                    ->state(function (array $attributes, Business $business) {
                        
                        $email = $attributes['email'];
                        $splitEmail = explode('@', $email);
                        $domain = $business->domain;
                        $usersEmail = $splitEmail[0].'@'.$domain;
                        return [
                            'email' => $usersEmail
                        ];
                    })
            )
            ->hasContacts(25)
            ->create();
    }
}
