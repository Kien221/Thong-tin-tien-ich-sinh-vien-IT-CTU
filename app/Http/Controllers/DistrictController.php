<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\DistrictsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WardsImport;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;
use App\Models\motel;

class DistrictController extends Controller
{
    public function import_excel(Request $request){
        Excel::import(new DistrictsImport, $request->file('file'));
        return redirect('admin/motel')->with('status', 'Thêm thành công');

    }
    public function import__ward_excel(Request $request){
        Excel::import(new WardsImport, $request->file('file'));
        return redirect('admin/motel')->with('status', 'Thêm thành công');

    }
    public function fillterMotel_District(Request $request){
        $district_id = $request->get('district_id');
        $wards = Ward::select('id','WardName')->where('district_id',$district_id)->get();
        $motels_on_district = motel::query()
                            ->join('wards','motels.ward_id','=','wards.id')
                            ->join('districts','wards.district_id','=','districts.id')
                            ->select('motels.*', DB::raw("DATE_FORMAT(motels.created_at, '%d-%m-%Y') as formatted_created_at"))
                            ->where('districts.id',$district_id)
                            ->get();
        return response()->json([
           'wards'=> $wards,
           'motels_on_district'=> $motels_on_district,
        ]);
    }
    public function fillterMotel_Ward(Request $request){
        $ward_id =$request->get('ward_id');
        $district_id = $request->get('district_id');
        $motel_on_ward = motel::query()
                            ->join('wards','motels.ward_id','=','wards.id')
                            ->join('districts','wards.district_id','=','districts.id')
                            ->where('districts.id',$district_id)
                            ->where('wards.id',$ward_id)
                            ->select('motels.*', DB::raw("DATE_FORMAT(motels.created_at, '%d-%m-%Y') as formatted_created_at"))
                            ->get();
        return response()->json([
            'motels_on_ward'=> $motel_on_ward,
        ]);
    }
}
