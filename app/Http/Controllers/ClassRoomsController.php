<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClassRoomsImport;
use Illuminate\Http\Request;
use App\Models\ClassRooms;

class ClassRoomsController extends Controller
{
    public function indexClassroom(){
        $classrooms = ClassRooms::all();
        
        return view('admin.classroom.classroom',compact('classrooms'));
    }
    public function ImportClassRooms(Request $request){
        Excel::import(new ClassRoomsImport, $request->file('file'));
        return redirect('admin/classroom')->with('status', 'Thêm thành công');
    }
    public function searchClassRoom(Request $request){
        $classrooms = ClassRooms::where('room_PW','like','%'.$request->search.'%')->get();
        return response()->json($classrooms);
    }
}
