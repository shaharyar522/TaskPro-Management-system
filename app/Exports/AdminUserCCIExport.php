<?php

namespace App\Exports;

use App\Models\UserCCI;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminUserCCIExport implements FromCollection, WithHeadings, WithMapping
{
    private $counter = 0;

    public function collection()
    {
        $query = UserCCI::with('user');

        // Filter by user_id if available
        if (request()->has('user_id') && request()->user_id != '') {
            $query->where('user_id', request()->user_id);
        }

        // Filter by date range
        if (request()->has('start_date') && request()->start_date != '') {
            $query->whereDate('created_at', '>=', request()->start_date);
        }

        if (request()->has('end_date') && request()->end_date != '') {
            $query->whereDate('created_at', '<=', request()->end_date);
        }

        return $query->get();
    }

    public function map($data): array
    {
        return [
            ++$this->counter,
            $data->created_at ? $data->created_at->format('m/d/Y') : '',
            $data->user->name ?? 'N/A',
            $data->user->last_name ?? 'N/A',
            $data->phone,
            $data->address,
            $data->master_order,
            $data->job_notes,
            $data->work_type,
            $data->unit,
            $data->qty,
            $data->w2,
            $data->in,
            $data->out,
            $data->hours,
        ];
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Date',
            'First Name',
            'Last Name',
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
        ];
    }
}
