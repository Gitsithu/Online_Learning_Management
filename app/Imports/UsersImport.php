<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'User Name'     => $row['name'],
            'User Email'    => $row['email'], 
            'Phone'    => $row['phone'], 
            'Address'    => $row['address'], 
            'Created At' => $row['created_at']
        ]);
    }
}
