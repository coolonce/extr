<?php

namespace App\Http\Controllers;

use App\Models\Passport;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function get(Request $request)
    {
        return response()->json(["data" => Passport::all()]);
    }

    public function update(Request $request, Passport $exr)
    {
        $data = $request->all();

        try {
            $exr->ch_id = $data['ch_id'];
            $exr->det_id = $data['det_id'];
            $exr->cvalue = $data['cvalue'];
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
            $exr = new Passport();
            $exr->ch_id = $data['ch_id'];
            $exr->det_id = $data['det_id'];
            $exr->cvalue = $data['cvalue'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function delete(Request $request, Passport $exr)
    {
        $exr->delete();
    }

    public function index()
    {
        return view('passport');
    }
}
