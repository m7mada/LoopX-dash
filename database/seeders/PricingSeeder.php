<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackagesBenefit;
use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country ;
use App\Models\Currency ;
use App\Models\PackagesPrice ;
use App\Models\Benefit ;


class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::updateOrInsert([
            'name' => "Egypt",
            "code"=> "eg",
        ]);

        Currency::updateOrInsert([
            "code"=> "EGP",
        ]) ;

        PackagesPrice::insert([
            "price"=>2000,
            "currency_id"=>Currency::where('code','EGP')->first()->id,
            "country_id"=>Country::where('code','eg')->first()->id,
            "package_id"=>Package::first()->id,
        ]);

        Benefit::insert([
            [
                "name"=> "Monthly Subscription",
                "type"=> "duration",
            ],
            [
                "name"=> "Credits",
                "type"=> "cridet",
            ],
            [
                "name"=> "Support",
                "type"=> "support",
            ]
            ]
        );

        PackagesBenefit::insert([
            [
                "package_id"=>Package::first()->id,
                "benefit_id"=>Benefit::where('type','duration')->first()->id,
                "value"=>1,
            ],
            [
                "package_id"=>Package::first()->id,
                "benefit_id"=>Benefit::where('type','cridet')->first()->id,
                "value"=>5,
            ],
            [
                "package_id"=>Package::first()->id,
                "benefit_id"=>Benefit::where('type','support')->first()->id,
                "value"=>2,
            ]
            ]
        );
        PaymentMethod::insertOrInsert([
            'name'=>'cash'
        ]);

    }
}
