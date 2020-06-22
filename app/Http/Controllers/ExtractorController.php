<?php

namespace App\Http\Controllers;

use App\Models\Extractor;
use Illuminate\Http\Request;

class ExtractorController extends Controller
{
    public function get(Request $request)
    {
        return response()->json(["data" => Extractor::all()]);
    }

    public function update(Request $request, Extractor $exr)
    {
        $data = $request->all();

        try {
            // $exr = Extragent::where('id', $data['id'])->first();
            $exr->ename = $data['ename'];
            $exr->inv_number = $data['inv_number'];
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
            $exr = new Extractor();
            $exr->ename = $data['ename'];
            $exr->inv_number = $data['inv_number'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function delete(Request $request, Extractor $exr)
    {
        $exr->delete();
    }

    public function index()
    {
        return view('extractor');
    }
}
