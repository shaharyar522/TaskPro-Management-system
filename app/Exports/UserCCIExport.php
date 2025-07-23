<?php

namespace App\Exports;

use App\Models\UserCCI;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserCCIExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return UserCCI::where('user_id', Auth::id())->get([
            'id','phone','address','master_order','job_notes','work_type','unit','qty',
            'w2','in', 'out','hours','created_at','updated_at'
        ]);
    }

    public function headings(): array
    {
        return [
           'id','phone','address','master_order','job_notes','work_type','unit','qty',
            'w2','in', 'out','hours','created_at','updated_at'
        ];
    }
}
