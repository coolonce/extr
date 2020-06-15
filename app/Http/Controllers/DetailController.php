<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailController extends Controller
{

    public function download(Request $request, Detail $detail)
    {
        $file = Storage::disk('public')->get('details/'.$detail->link);
        return response()->json(["data" => base64_encode($file)]);
    }

    public function get(Request $request)
    {
        return response()->json(["data" => Detail::all()]);
    }

    public function update(Request $request, Detail $exr)
    {
        $data = $request->all();

        try {
            $exr->name = $data['name'];
            $exr->type_id = $data['type_id'];
            $exr->link = $data['link'];
            $exr->thin_section = $data['thin_section'];
            $exr->diameter = $data['diameter']?? null;
            $exr->volume = $data['volume'] ?? null;
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
            $exr = new Detail();
            $exr->name = $data['name'];
            $exr->type_id = $data['type_id'];
            $exr->link = $data['link'];
            $exr->thin_section = $data['thin_section'];
            $exr->diameter = $data['diameter']?? null;
            $exr->volume = $data['volume'] ?? null;
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function delete(Request $request, Detail $exr)
    {
        $exr->delete();
    }

    public function index()
    {
        return view('detail');
    }
}
