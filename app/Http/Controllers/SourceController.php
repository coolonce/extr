<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function get(Request $request)
    {
        return response()->json(["data" => Source::all()]);
    }

    public function update(Request $request, Source $exr)
    {
        $data = $request->all();

        try {
            $exr->name = $data['name'];
            $exr->percents = $data['percents'];
            $exr->mass = $data['mass'];
            $exr->average_radius = $data['average_radius'];
            $exr->layer_porosity = $data['layer_porosity'];
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
            $exr = new Source();
            $exr->name = $data['name'];
            $exr->percents = $data['percents'];
            $exr->mass = $data['mass'];
            $exr->average_radius = $data['average_radius'];
            $exr->layer_porosity = $data['layer_porosity'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function delete(Request $request, Source $exr)
    {
        $exr->delete();
    }

    public function index()
    {
        return view('source');
    }
}
