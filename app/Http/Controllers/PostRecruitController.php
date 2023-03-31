<?php

namespace App\Http\Controllers;
use App\Models\PostRecruit;
use App\Models\City;
use App\Http\Requests\StorePostRecruitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Models\Object_Languages;
class PostRecruitController extends Controller
{
    public function index()
    {
       
        return view('admin.postRecruitAdMin.postrecruit');
    }
    public function indexAPI(){
        $postRecruit = PostRecruit::query()
        ->join('cities','post_recruits.city_id','=','cities.id')
        ->select('logo','city_id','job_title','company_name','post_recruits.created_at','slug')
        ->groupBy('logo','city_id','job_title','company_name','post_recruits.created_at','slug')
        ->get();
    return Datatables::of($postRecruit)
    ->editColumn('company_address', function ($postRecruit) {
        return $postRecruit->city->name;
    })
    ->addColumn('stt',function($postRecruit){
        return 1;
    })
    ->editColumn('logo',function($postRecruit){
        return '<img src="'.asset('storage/images/postRecruit/'.$postRecruit->logo).'" width="100px" height="100px">';
    })
    ->editColumn('created_at',function($postRecruit){
        return Carbon::parse($postRecruit->created_at)->format('d/m/Y');
    })
    ->addColumn('edit',function($postRecruit){
        return route('admin.postRecruit.edit',$postRecruit->slug);
    })
    ->addColumn('delete',function($postRecruit){
        return route('admin.postRecruit.destroy',$postRecruit->slug);
    })
    ->rawColumns(['logo','edit','delete'])
    ->make(true);

    }
    public function postRecruit_Index()
    {
        Carbon::setLocale('vi');
        $cities = City::all();
        $language_all = DB::table('languages')->get();
        $postRecruit_random = PostRecruit::inRandomOrder()->take(10)
        ->select('logo','city_id','job_title','company_name','post_recruits.created_at','slug','company_address','job_description','salary','id')
        ->get();
        for($i = 0; $i< count($postRecruit_random); $i++){
            $languages = Object_Languages::query()
            ->join('languages','object__languages.language_id','=','languages.id')
            ->where('post_recruit_id',$postRecruit_random[$i]->id)->get('Language_Name');
        }
        
        $postRecruit_new = PostRecruit::orderBy('created_at','desc')
        ->take(10)
        ->select('logo','city_id','job_title','company_name','post_recruits.created_at','slug','company_address','job_description','salary','id')
        ->get();
        for($i = 0; $i< count($postRecruit_new); $i++){
            $languages_new_post = Object_Languages::query()
            ->join('languages','object__languages.language_id','=','languages.id')
            ->where('post_recruit_id',$postRecruit_new[$i]->id)->get('Language_Name');
        }
        return view('client.postRecruit.postRecruit',compact('cities','postRecruit_random','postRecruit_new','languages','language_all','languages_new_post'));
    }

    public function addView(){
        $cities = DB::table('cities')->get();
        $languages = DB::table('languages')->get();
        return view('admin.postRecruitAdMin.addpostrecruit',compact('cities','languages'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRecruitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if($request->has('img')){
            $destination_path = 'public/images/postRecruit';    
            $file = $request ->file('img');
            $fileName = $file ->getClientOriginalName();
            $path = $request->file('img')->storeAs($destination_path,$fileName);
            $input['img'] = $fileName;
        }
        $input['slug'] = Str::slug($request->Company_Name);
        $languages = $input['language_id'];
        // for($i=0;$i<count($language_id);$i++){
        //     $postRecruit = [
        //         'company_name' => $request->get('Company_Name'),
        //         'city_id' => $request->get('city_id'),
        //         'company_address' => $request->get('Address'),
        //         'company_email' =>$request->get('company_email'),
        //         'job_title' => $request->get('job_title'),
        //         'salary' => $request->get('salary'),
        //         'job_description' => $request->get('job_description'),
        //         'logo'=> $input['img'],
        //         'slug'=> $input['slug'],
        //         'language_id' => $language_id[$i],
        //     ];
        //     PostRecruit::create($postRecruit);
           
        // }
        $arr = [
                    'company_name' => $request->get('Company_Name'),
                    'city_id' => $request->get('city_id'),
                    'company_address' => $request->get('Address'),
                    'company_email' =>$request->get('company_email'),
                    'job_title' => $request->get('job_title'),
                    'salary' => $request->get('salary'),
                    'job_description' => $request->get('job_description'),
                    'logo'=> $input['img'],
                    'slug'=> $input['slug'],
                ];
        $postRecruit = PostRecruit::create($arr);
        foreach($languages as $language){
            Object_languages::create([
                'post_recruit_id' => $postRecruit->id,
                'language_id' => $language,
            ]);
        }
        return redirect('admin/postrecruit')->with('success', 'Data Added successfully');
    }

    public function postRecruit_Detail(Request $request, $slug){
        Carbon::setLocale('vi');
        $cities = City::all();
        $post_recruit = PostRecruit::where('slug',$slug)->first();
        $languages = Object_Languages::query()
        ->join('languages','object__languages.language_id','=','languages.id')
        ->where('post_recruit_id',$post_recruit->id)->get('Language_Name');
        $postRecruits_new = PostRecruit::orderBy('created_at','desc')
        ->take(10)
        ->select('logo','city_id','job_title','company_name','post_recruits.created_at','slug','company_address','job_description','salary')
        ->get();
        $language_all = DB::table('languages')->get();

        return view('client.postRecruit.postRecruit_Detail',compact('cities','post_recruit','postRecruits_new','languages','language_all'));

    } 
    public function postRecruit_fillter(Request $request){
        $districts = $request->get('district_id');
        $postrecruit_fillter = PostRecruit::query()->where('city_id',$districts)->get();
        $data_html = null;
        if($postrecruit_fillter){
        for($i = 0; $i<count($postrecruit_fillter); $i++){
            $languages = Object_Languages::query()
            ->join('languages','object__languages.language_id','=','languages.id')
            ->where('post_recruit_id',$postrecruit_fillter[$i]->id)->get('Language_Name');
            session()->put('success', 'Data Added successfully');
            
            $data_html = view('client.postRecruit.postRecruit_ajax',compact('postrecruit_fillter','languages'))->render();
        }
        }
        else{
            session()->put('error', 'Data Added successfully');
            $data_html = view('client.postRecruit.postRecruit_ajax')->render();
        }

        return response()->json(['data_html'=>$data_html]);

    }
    public function postRecruit_fillter_language(Request $request){
        $language_id = $request->get('language_id');
        $postrecruit_fillter = PostRecruit::query()
        ->join('object__languages','object__languages.post_recruit_id','=','post_recruits.id')
        ->where('language_id',$language_id)->get('post_recruits.*');
        $data_html = null;
        if($postrecruit_fillter){
        for($i = 0; $i<count($postrecruit_fillter); $i++){
            $languages = Object_Languages::query()
            ->join('languages','object__languages.language_id','=','languages.id')
            ->where('post_recruit_id',$postrecruit_fillter[$i]->id)->get('Language_Name');
            session()->put('success', 'Data Added successfully');
            
            $data_html = view('client.postRecruit.postRecruit_ajax',compact('postrecruit_fillter','languages'))->render();
        }
        }
        else{
            session()->put('error', 'Data Added successfully');
            $data_html = view('client.postRecruit.postRecruit_ajax')->render();
        }

        return response()->json(['data_html'=>$data_html]);

    }
    public function show(PostRecruit $postRecruit)
    {
        //
    }

   
    public function edit(PostRecruit $postRecruit)
    {
        //
    }


    public function update(UpdatePostRecruitRequest $request, PostRecruit $postRecruit)
    {
        //
    }


    public function destroy(PostRecruit $postRecruit)
    {
        //
    }
}
