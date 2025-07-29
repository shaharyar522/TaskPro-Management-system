<?php

namespace App\Exports;

use App\Models\UserFrontier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdminUserFrontierExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private $counter = 0;

    public function collection()
    {
        $query = UserFrontier::with('user');

        if (request()->filled('user_id')) {
            $query->where('user_id', request()->user_id);
        }

        if (request()->filled('start_date')) {
            $query->whereDate('created_at', '>=', request()->start_date);
        }

        if (request()->filled('end_date')) {
            $query->whereDate('created_at', '<=', request()->end_date);
        }

        return $query->get();
    }

    public function map($data): array
    {
        return [
            ++$this->counter,
            optional($data->created_at)->format('m/d/Y'),
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

    public function headings(): array
    {
        return [
            'S.No',
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
