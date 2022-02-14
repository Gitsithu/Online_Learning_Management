<?php

namespace App\Exports;
use DB;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
class UsersExport implements FromCollection,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::select('id','name','email','phone','address',
                    \DB::raw('(CASE 
                        WHEN status = "1" THEN "Active" 
                        ELSE "Inactive" 
                        END) AS status'),'created_at')
                ->get();
            return $users;

    }

    public function headings(): array {
        return [
            "ID","User Name","Email","Phone","Address","status","Created_at"
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
            'F' => 15,
            'G' => 30,          
        ];
    }
}
