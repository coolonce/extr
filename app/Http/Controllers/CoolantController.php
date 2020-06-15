<?php

namespace App\Http\Controllers;

use App\Models\Coolant;
use Illuminate\Http\Request;

class CoolantController extends Controller
{

    public function get(Request $request)
    {
        return response()->json(["data" => Coolant::all()]);
    }

    public function update(Request $request, Coolant $exr)
    {
        $data = $request->all();

        try {
            $exr->name = $data['name'];
            $exr->start_viscosity = $data['start_viscosity'];
            $exr->start_density = $data['start_density'];
            $exr->c = $data['c'];
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
            $exr = new Coolant();
            $exr->name = $data['name'];
            $exr->start_viscosity = $data['start_viscosity'];
            $exr->start_density = $data['start_density'];
            $exr->c = $data['c'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function delete(Request $request, Coolant $exr)
    {
        $exr->delete();
    }

    public function index()
    {
        return view('coolant');
    }
}
