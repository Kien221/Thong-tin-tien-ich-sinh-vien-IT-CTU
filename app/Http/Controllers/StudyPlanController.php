<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Majors;
use App\Models\Khoas;
use App\Models\StudyPlan;
use App\Imports\StudyPlanImport;
use Maatwebsite\Excel\Facades\Excel;
class StudyPlanController extends Controller
{
    public function index(){
        $majors = Majors::all();
        return view('admin.studyplan.studyplan',compact('majors'));
    }
    public function editStudyPlan_of_Major_View(Request $request, $id){
        $major = Majors::find($id);
        $majors = Majors::all();
        return view('admin.studyplan.editstudyplan',compact('major','majors'));
    }
    public function update(Request $request,Majors $major){
       $major = Majors::find($request->major_id);
       $rq = $request->all();
        if($request->hasFile('file_excel')){
            $destination_path = 'public/file_doc_upload';
            $file = $request -> file('file_excel');
            $fileName = $file ->getClientOriginalName();
            $path = $request->file('file_excel')->storeAs($destination_path,$fileName);
            $rq['file'] = $fileName;
        }
        $major->file=$rq['file'];
        $major->update(
            $request->except([
            '_token',
            '_method'
                ])
        );
        $major_id = StudyPlan::where('Major_ID',$major->id)->get();
        if($major != NULL){
            foreach($major_id as $major_id){
                $major_id->delete();
            }
            Excel::import(new StudyPlanImport($request->major_id), $request->file('file_excel'));
        }
        else{
            Excel::import(new StudyPlanImport($request->major_id), $request->file('file_excel'));
        }
        
        return redirect('admin/studyplan')->with('status', 'Cập nhật thành công');
    }
    public function ImportStudy_Plan(Request $request){
        dd($request->all());
        $request->validate([
            'file_excel' => 'required|mimes:xls,xlsx'
        ]);
        $file = $request->file('file_excel');
        Excel::import(new StudyPlanImport($request), $file);
        return redirect('admin/studyplan')->with('status', 'Thêm thành công');
    }
    

    public function clientStudyPlan(Request $request){
        $majors = Majors::all();
        $khoas = Khoas::all();
        return view('client.study_plan.studyplan',compact('majors','khoas'));

    }
    public function clientStudyPlanDetail(Request $request){
       $study_plans = StudyPlan::where('Major_ID',$request->major_id)->get();
       $infor_major_khoa = Majors::query()
       ->join('khoas','khoas.id','=','majors.Khoa_ID')
       ->where('majors.id',$request->major_id)
       ->select('majors.Major_Code as Major_Code','majors.Major_Name as Major_Name','khoas.Khoa_Name as Khoa_Name')
       ->get();
       return response()->json([
        'study_plans'=>$study_plans,
        'infor_major_khoa'=>$infor_major_khoa
    ]);
    }

}
