<?php

namespace App\Http\Controllers;

use App\Models\motel;
use App\Http\Requests\StoremotelRequest;
use App\Http\Requests\UpdatemotelRequest;
use App\Models\Ward;
use Illuminate\Http\Request;
use App\Models\Districts;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Str;



class MotelController extends Controller
{

    public function index()
    {
        return view('admin.motel.motel');
    }
    public function indexAPI()
    {
        $motel = motel::query()
            ->join('wards','motels.ward_id','=','wards.id')
            ->join('districts','wards.district_id','=','districts.id')
            ->select('motels.*','wards.WardName','districts.DistrictName')
            ->get();
        return Datatables::of($motel)
        ->editColumn('id',function($motel){
            return 1;
        })
        ->editColumn('ward_id', function ($motel) {
            return $motel->ward->WardName;
        })
        ->editColumn('district_id',function($motel){
            return $motel->ward->district->DistrictName;
        })
        ->editColumn('img',function($motel){
            return '<img src="'.asset('storage/images/motel/'.$motel->img).'" width="100px" height="100px">';
        })
        ->editColumn('created_at',function($motel){
            return Carbon::parse($motel->created_at)->format('d/m/Y');
        })
        ->addColumn('edit',function($motel){
            return route('admin.motel.edit',$motel->slug);
        })
        ->addColumn('delete',function($motel){
            return route('admin.motel.destroy',$motel->slug);
        })
        ->rawColumns(['img','edit','delete'])
        ->make(true);
    }
    public function addView()
    {
        $wards = Ward::all();
        $districts = Districts::all();
        return view('admin.motel.addmotel',compact('wards','districts'));
    }
    public function getWard(Request $request){
        $district_id = $request->district_id;
        $wards = Ward::where('district_id',$district_id)->get();
        return response()->json([
            'getward'=>$wards,
        ]);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        if($request->has('img')){
            $destination_path = 'public/images/motel';
            $file = $request ->file('img');
            $fileName = $file ->getClientOriginalName();
            $path = $request->file('img')->storeAs($destination_path,$fileName);
            $input['img'] = $fileName;
        }
        $input['slug'] = Str::slug($request->MotelName);
        motel::create($input);
        return redirect('admin/motel')->with('success', 'Data Added successfully');
    }

    public function edit(Request $request,$slug)
    {
        $districts= Districts::get();
        $wards = Ward::get(); 
        $motel = motel::where('slug',$slug)->first();
        return view('admin.motel.editmotel',compact('motel','districts','wards'));
    }

    public function update(Request $request,$slug)
    {
        $motel = motel::where('slug',$slug)->first();
        $rq = $request->all();
        if($request->has('img')){
            $destination_path = 'public/images/motel';
            $file = $request ->file('img');
            $fileName = $file ->getClientOriginalName();
            $path = $request->file('img')->storeAs($destination_path,$fileName);
            $rq['img'] = $fileName;
        }
        $rq['slug'] = Str::slug($request->MotelName);
        $motel->update($rq);
        return redirect('admin/motel')->with('message', 'Cập nhật thành công');
    }

    public function destroy($slug)
    {
        $motel = motel::where('slug',$slug)->first();
        $motel->delete();
        return redirect('admin/motel')->with('message', 'Xóa thành công');
    }

    //CLIENT
    public function clientMotel(){
        $motel_ramdoms = motel::inRandomOrder()->take(10)->get();
        $motel_news = motel::orderBy('created_at','desc')->take(10)->get();
        $districts = Districts::all();
        $wards  = Ward::get();
        Carbon::setLocale('vi');
        $costs = motel::select('prices')->distinct()->get();
        return view('client.motel.motel',compact('motel_ramdoms','motel_news','districts','wards','costs'));
    }
    public function clientMotelDetail($slug){
        $districts = Districts::all();
        Carbon::setLocale('vi');
        $motel_news = motel::orderBy('created_at','desc')->take(10)->get();
        $wards  = Ward::get();
        $motel = motel::where('slug',$slug)->first();
        return view('client.motel.motel_detail',compact('motel','districts','wards','motel_news'));  
    }
}
