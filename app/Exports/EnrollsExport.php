<?php

namespace App\Exports;
use DB;
use App\Models\Enroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnrollsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('enrolls')
        ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        ->join('users', 'users.id', '=', 'enrolls.User_ID')
        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        ->select('enrolls.id','users.name','courses.title','payments.name as bank_name',
        'enrolls.amount','enrolls.created_at'
        )
        ->get();
        // return Enroll::all();
    }
    
    public function headings(): array {
        return [
            "ID","Name","Course Name","Bank Name","Amount","Created_at"
        ];
    }
}
