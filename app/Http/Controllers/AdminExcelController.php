<?php

namespace App\Http\Controllers;

use App\Imports\WorkersImport;
use App\Models\Worker;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AdminExcelController extends Controller
{
    public function index() {

        $workers = Worker::with('giftcard')->get();
        return view('admin.dashboard')->with('workers',$workers);

    }

    public function importExcel(){
        return view('admin.importExcel');
    }


    public function postExcel(Request $request) {


        Excel::import(new WorkersImport,request()->file('file'));

        return back()->with('success', 'User Imported Successfully.');
    }
}
