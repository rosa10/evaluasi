<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromArray;

class UserExport implements FromArray
{
    public function array(): array
    {
        return [
            ['nama', 'email@email.com', 'password'],
            ['rosa', '10161083@student.itk.ac.id', '10161083']
        ];
    }
}
