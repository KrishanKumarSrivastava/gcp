<?php

namespace Database\Seeders;

use Botble\Ecommerce\Models\Make;
use Botble\Ecommerce\Models\CarModel;
use Botble\Ecommerce\Models\CarYear;
use Botble\Ecommerce\Models\CarVariant;
use Illuminate\Database\Seeder;

class CarDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create Makes
        $toyotaMake = Make::create(['name' => 'Toyota']);
        $hondaMake = Make::create(['name' => 'Honda']);
        $fordMake = Make::create(['name' => 'Ford']);
        $bmwMake = Make::create(['name' => 'BMW']);
        $audiMake = Make::create(['name' => 'Audi']);

        // Create Models for Toyota
        $camryModel = CarModel::create(['make_id' => $toyotaMake->id, 'name' => 'Camry']);
        $corollaModel = CarModel::create(['make_id' => $toyotaMake->id, 'name' => 'Corolla']);
        $pradoModel = CarModel::create(['make_id' => $toyotaMake->id, 'name' => 'Prado']);

        // Create Models for Honda
        $civicModel = CarModel::create(['make_id' => $hondaMake->id, 'name' => 'Civic']);
        $accordModel = CarModel::create(['make_id' => $hondaMake->id, 'name' => 'Accord']);
        $crvModel = CarModel::create(['make_id' => $hondaMake->id, 'name' => 'CR-V']);

        // Create Models for Ford
        $f150Model = CarModel::create(['make_id' => $fordMake->id, 'name' => 'F-150']);
        $focusModel = CarModel::create(['make_id' => $fordMake->id, 'name' => 'Focus']);
        $mustangModel = CarModel::create(['make_id' => $fordMake->id, 'name' => 'Mustang']);

        // Create Models for BMW
        $x3Model = CarModel::create(['make_id' => $bmwMake->id, 'name' => 'X3']);
        $seriesModel = CarModel::create(['make_id' => $bmwMake->id, 'name' => '3 Series']);

        // Create Models for Audi
        $a4Model = CarModel::create(['make_id' => $audiMake->id, 'name' => 'A4']);
        $q5Model = CarModel::create(['make_id' => $audiMake->id, 'name' => 'Q5']);

        // Create Years for models (sample data)
        $models = [$camryModel, $corollaModel, $pradoModel, $civicModel, $accordModel, $crvModel, $f150Model, $focusModel, $mustangModel, $x3Model, $seriesModel, $a4Model, $q5Model];
        $years = ['2018', '2019', '2020', '2021', '2022', '2023', '2024'];

        foreach ($models as $model) {
            foreach ($years as $year) {
                $carYear = CarYear::create([
                    'make_id' => $model->make_id,
                    'model_id' => $model->id,
                    'year' => $year
                ]);

                // Create variants for each year
                $variants = [];
                switch ($model->name) {
                    case 'Camry':
                        $variants = ['LE', 'SE', 'XLE', 'XSE'];
                        break;
                    case 'Corolla':
                        $variants = ['L', 'LE', 'SE', 'XLE'];
                        break;
                    case 'Prado':
                        $variants = ['VX', 'VXL', 'TXL'];
                        break;
                    case 'Civic':
                        $variants = ['LX', 'Sport', 'EX', 'Touring'];
                        break;
                    case 'Accord':
                        $variants = ['LX', 'Sport', 'EX-L', 'Touring'];
                        break;
                    case 'CR-V':
                        $variants = ['LX', 'EX', 'EX-L', 'Touring'];
                        break;
                    case 'F-150':
                        $variants = ['Regular Cab', 'SuperCab', 'SuperCrew'];
                        break;
                    case 'Focus':
                        $variants = ['S', 'SE', 'SEL', 'ST'];
                        break;
                    case 'Mustang':
                        $variants = ['EcoBoost', 'GT', 'Shelby GT350', 'Shelby GT500'];
                        break;
                    case 'X3':
                        $variants = ['sDrive30i', 'xDrive30i', 'M40i'];
                        break;
                    case '3 Series':
                        $variants = ['330i', '340i', 'M3'];
                        break;
                    case 'A4':
                        $variants = ['Premium', 'Premium Plus', 'Prestige'];
                        break;
                    case 'Q5':
                        $variants = ['Premium', 'Premium Plus', 'Prestige'];
                        break;
                    default:
                        $variants = ['Base', 'Standard', 'Premium'];
                        break;
                }

                foreach ($variants as $variantName) {
                    CarVariant::create([
                        'make_id' => $model->make_id,
                        'model_id' => $model->id,
                        'year_id' => $carYear->id,
                        'name' => $variantName
                    ]);
                }
            }
        }
    }
}