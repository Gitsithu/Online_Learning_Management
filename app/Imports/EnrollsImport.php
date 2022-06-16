<?php

namespace App\Imports;

use App\Models\Enroll;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class EnrollsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Enroll([
            'User Name'     => $row['User_ID'],
            'Course Name'    => $row['Course_ID'], 
            'Course Amount'    => $row['Payment_ID'], 
            'Course Payment Slip'    => $row['image'], 
            'Course Status' => $row['status'],
            'Created At' => $row['created_at']
        ]);
    }
}