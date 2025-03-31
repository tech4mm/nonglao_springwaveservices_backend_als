<?php

namespace Database\Seeders;

use App\Models\CompanyDetails;
use App\Models\ContactUs;
use App\Models\PrivacyPolicy;
use App\Models\TermsCondition;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '09777565656',
            'password' => bcrypt('123123123'),
        ]);
        TermsCondition::factory()->create([
            'body' => 'This is the terms and conditions of the website',
        ]);
        PrivacyPolicy::factory()->create([
            'body' => 'This is the privacy policy of the website',
        ]);
        CompanyDetails::factory()->create([
            'application_details' => 'This is the privacy policy of the website',
            'company_address'=> 'This is the privacy policy of the website',
            'company_bank_details'=> 'This is the privacy policy of the website',
        ]);
        ContactUs::factory()->create([
            'contact_phone' => '09777562256',
        ]);
    }
}
