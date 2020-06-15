<?php

namespace App\Http\Controllers;

use App\Models\Charact;
use Illuminate\Http\Request;

class CharactController extends Controller
{

    public function get(Request $request)
    {
        return response()->json(["data" => Charact::all()]);
    }

    public function update(Request $request, Charact $exr)
    {
        $data = $request->all();

        try {
            $exr->cname = $data['cname'];
            $exr->citem = $data['citem'];
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
            $exr = new Charact();
            $exr->cname = $data['cname'];
            $exr->citem = $data['citem'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function delete(Request $request, Charact $exr)
    {
        $exr->delete();
    }

    public function index()
    {
        return view('characts');
    }
}
