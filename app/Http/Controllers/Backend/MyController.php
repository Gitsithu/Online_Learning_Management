<?php

namespace App\Http\Controllers\Backend;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EnrollsExport;
use App\Imports\EnrollsImport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new EnrollsExport, 'Enrollment.xlsx');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new EnrollsImport,request()->file('file'));
             
        return back();
    }
}
