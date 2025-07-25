<?php

namespace App\Exports;

use App\Models\UserCCI;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminUserCCIExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return UserCCI::select(
            'id',
            'phone',
            'address',
            'master_order',
            'job_notes',
            'work_type',
            'unit',
            'qty',
            'w2',
            'in',
            'out',
            'hours',
            'created_at',
            'updated_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Phone',
            'Address',
            'Master Order',
            'Job Notes',
            'Work Type',
            'Unit',
            'Qty',
            'W2',
            'In',
            'Out',
            'Hours',
            'created_at',
            'updated_at'
        ];
    }
}
