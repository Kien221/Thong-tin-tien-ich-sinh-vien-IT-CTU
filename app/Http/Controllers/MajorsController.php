<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MajorsImport;

class MajorsController extends Controller
{
    public function ImportMajors(Request $request){
        Excel::import(new MajorsImport, $request->file('file'));
        return redirect('admin/studyplan')->with('status', 'Thêm thành công');

    }
    
}
