<?php

namespace App\Exports;

use App\Models\UserFrontier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminUserFrontierExport implements FromCollection, WithHeadings, WithMapping
{
    private $counter = 0; // For loop iteration

    public function collection()
    {
        $query = UserFrontier::with('user'); // Load user relation

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

    /**
     * Map each record for export
     */
    public function map($data): array
    {
        return [
            ++$this->counter, // Loop iteration instead of ID
            $data->created_at ? $data->created_at->format('m/d/Y') : '',
            $data->user->name ?? 'N/A',
            $data->user->last_name ?? 'N/A',
            $data->corp_id,
            $data->address,
            $data->billing_TN,
            $data->order_number,
            $data->install_T_T_Soc_TTC,
            $data->ont_Ntd,
            $data->comp_or_refer,
            $data->billing_code,
            $data->qty,
            $data->description,
            $data->rate,
            $data->total_billed,
            $data->aerial_buried,
            $data->fiber,
            $data->closeout_notes,
            $data->in,
            $data->out,
            $data->hours,
        ];
    }

    /**
     * Excel headings
     */
    public function headings(): array
    {
        return [
            'S.No',  // Serial number instead of ID
            'Date',
            'First Name',
            'Last Name',
            'Corp ID',
            'Address',
            'Billing TN',
            'Order Number',
            'Install T.T. Soc TTC',
            'ONT NTD',
            'Comp/Refer',
            'Billing Code',
            'Qty',
            'Description',
            'Rate',
            'Total Billed',
            'Aerial Buried',
            'Fiber',
            'Closeout Notes',
            'In',
            'Out',
            'Hours',
        ];
    }
}
