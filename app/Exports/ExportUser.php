<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUser implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
//        return User::select('Emd_id','mobile','name','family')->get();
        return User::select('Emd_id', 'mobile','name','family')->get();
    }

    /**
     * @return array
     */
    /**
     * @return array
     */
    public function headings(): array{
        // TODO: Implement headings() method.
        return[
            'Personnel_ID',
            'User_Mobile',
            'Name',
            'Family'
        ];

    }
}
