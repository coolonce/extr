<?php

namespace App\Http\Controllers;

use App\Models\Extragent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtragentController extends Controller
{
    public function get(Request $request)
    {
        return response()->json(["data" => Extragent::all()]);
    }

    public function update(Request $request, Extragent $exr)
    {
        $data = $request->all();

        try {
            // $exr = Extragent::where('id', $data['id'])->first();
            $exr->name = $data['name'];
            $exr->V = $data['V'];
            $exr->T_vaporization = $data['T_vaporization'];
            $exr->T_condinsasion = $data['T_condinsasion'];
            $exr->viscosity = $data['viscosity'];
            $exr->density = $data['density'];
            $exr->molecular_mass_vap = $data['molecular_mass_vap'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function create(Request $request)
    {
        $data = $request->all();

        try {
            $exr = new Extragent();
            $exr->name = $data['name'];
            $exr->V = $data['V'];
            $exr->T_vaporization = $data['T_vaporization'];
            $exr->T_condinsasion = $data['T_condinsasion'];
            $exr->viscosity = $data['viscosity'];
            $exr->density = $data['density'];
            $exr->molecular_mass_vap = $data['molecular_mass_vap'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function delete(Request $request, Extragent $exr)
    {
        $exr->delete();
    }

    public function index()
    {
        return view('extragent');
    }
}
