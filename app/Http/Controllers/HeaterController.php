<?php

namespace App\Http\Controllers;

use App\Models\Heater;
use Illuminate\Http\Request;

class HeaterController extends Controller
{
    public function get(Request $request)
    {
        return response()->json(["data" => Heater::all()]);
    }

    public function update(Request $request, Heater $exr)
    {
        $data = $request->all();

        try {
            $exr->type = $data['type'];
            $exr->power = $data['power'];
            $exr->effective_heating_area = $data['effective_heating_area'];
            $exr->efficiency = $data['efficiency'];
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
            $exr = new Heater();
            $exr->type = $data['type'];
            $exr->power = $data['power'];
            $exr->effective_heating_area = $data['effective_heating_area'];
            $exr->efficiency = $data['efficiency'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function delete(Request $request, Heater $exr)
    {
        $exr->delete();
    }

    public function index()
    {
        return view('heater');
    }
}
