<?php

namespace App\Exports;
use DB;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')
        ->select('id','name','email','phone','address','created_at'
        )
        ->get();

    }

    public function headings(): array {
        return [
            "ID","User Name","Email","Phone","Address","Created_at"
        ];
    }
}
