<?php

namespace App\Exports;
use DB;
use App\Models\Enroll;
use App\Models\Enrollsapp;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\FromCollection;

class EnrollsappExport implements FromCollection,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $enrolls = Enroll::join('courses', 'courses.id', '=', 'enrolls.Course_ID')
                        ->join('users', 'users.id', '=', 'enrolls.User_ID')
                        ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
                        ->select('enrolls.id','users.name','courses.title','payments.name as bank_name',
                        'enrolls.amount', 
                    \DB::raw('(CASE 
                        WHEN enrolls.status = "1" THEN "Pending" 
                        WHEN enrolls.status = "2" THEN "Approved" 
                        ELSE "Rejected" 
                        END) AS status'),'enrolls.created_at')
                        ->where('enrolls.status',2)
                        ->get();
            return $enrolls;
        
        // $enrolls= DB::table('enrolls')
        // ->join('courses', 'courses.id', '=', 'enrolls.Course_ID')
        // ->join('users', 'users.id', '=', 'enrolls.User_ID')
        // ->join('payments', 'payments.id', '=', 'enrolls.Payment_ID')
        // ->select()
        // ->get();

        // dd($enrolls);

        
    }
    
    public function headings(): array {
        return [
            "ID","Name","Course Name","Bank Name","Amount","status","Created_at"
        ];
    }



    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 15,
            'C' => 30,
            'D' => 20,
            'E' => 15,
            'F' => 10, 
            'G' => 30,            
        ];
    }
}
