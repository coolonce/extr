<?php

use App\Models\Charact;
use App\Models\Coolant;
use App\Models\Detail;
use App\Models\Extractor;
use App\Models\Extragent;
use App\Models\Heater;
use App\Models\Source;
use App\Models\TypeOfDetails;
use Illuminate\Database\Seeder;

class FiilStartDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types_of_details = [
            ["name"=> "Нижняя колба","type"=> "1"],
            ["name"=> "Верхняя колба","type"=> "2"],
            ["name"=> "Обратный холодильник","type"=> "3"]
        ];
        foreach($types_of_details as $extr){
            $typedetail = new TypeOfDetails();
            foreach($extr as $name => $val){
                $typedetail->{$name} = $val;
            }
            $typedetail->save();
        }
        $characts = [
            ['cname'=> 346, 'citem'=>235],
            ['cname'=> 346, 'citem'=>235]
        ];

        foreach($characts as $extr){
            $charact = new Charact();
            foreach($extr as $name => $val){
                $charact->{$name} = $val;
            }
            $charact->save();
        }

        $coolants = [
            ["name"=> "Вода", "start_viscosity"=>0.000001006, "start_density"=>997, "c"=> 4183]
        ];
        foreach($coolants as $cool){
            $coolant = new Coolant();
            foreach($cool as $name => $val){
                $coolant->{$name} = $val;
            }
            // dd($coolant);
            $coolant->save();
        }

        $source = new Source();
        $source->name = 'Сырье 1';
        $source->percents = 65.5;
        $source->mass = 0.05;
        $source->average_radius = 0.007;
        $source->layer_porosity = 0.005;
        $source->save();

        $details = [
            ['name' => "Плоскодонная колба 500 мл", 'type_id'=>1, 'link' => "", 'thin_section'=>"29/32", 'diameter'=> 40, 'volume'=>0.5],
            ['name' => "Шариковый холодильник", 'type_id'=>3, 'link' => "", 'thin_section'=>"29/32", 'diameter'=> null, 'volume'=>null],
            ['name' => "Плоскодонная колба 500 мл", 'type_id'=>2, 'link' => "", 'thin_section'=>"29/32", 'diameter'=> null, 'volume'=>null],
        ];
        foreach($details as $det){
            $detail = new Detail();
            foreach($det as $name => $val){
                $detail->{$name} = $val;
            }
            $detail->save();
        }

        $extractor = new Extractor();
        $extractor->ename = '1';
        $extractor->inv_number = 1;
        $extractor->save();

        $heater = new Heater();
        $heater->type = 'Плитка электрическая';
        $heater->power = 1000;
        $heater->effective_heating_area = 15.2;
        $heater->efficiency = 65;
        $heater->save();

        $extragents = new Extragent();
        $extragents->name = 'Ортоксилол';
        $extragents->V =  0.5;
        $extragents->T_vaporization = 144;
        $extragents->T_condinsasion = 144;
        $extragents->viscosity = 0.878;
        $extragents->density = 0.76;
        $extragents->molecular_mass_vap = 106.17;
        $extragents->save();

    }
}
