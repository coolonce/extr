<?php

namespace App\Http\Controllers;

use App\Models\Extractor;
use App\Models\ExtractorDetail;
use Illuminate\Http\Request;

class ExtractorDetailController extends Controller
{
    public function get(Request $request)
    {
        return response()->json(["data" => ExtractorDetail::all()]);
    }

    public function update(Request $request, ExtractorDetail $exr)
    {
        $data = $request->all();

        try {
            // $exr = Extragent::where('id', $data['id'])->first();
            $exr = new ExtractorDetail();
            $exr->detail_id = $data['detail_id'];
            $exr->extractor_id = $data['extractor_id'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        } catch (\Throwable $th) {
            return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        }
    }

    public function create(Request $request)
    {
        $data = $request->all();

        // try {
            $exr = new ExtractorDetail();
            $exr->detail_id = $data['detail_id'];
            $exr->extractor_id = $data['extractor_id'];
            $exr->save();
            return response()->json(["msg"=>"good"]);
        // } catch (\Throwable $th) {
        //     return response()->json(["msg"=>"Произошла ошибка при сохранении"], 500);
        // }
    }

    public function delete(Request $request, ExtractorDetail $exr)
    {
        $exr->delete();
    }

    public function index()
    {
        return view('extractor-details');
    }
}
