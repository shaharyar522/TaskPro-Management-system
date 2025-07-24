<?php

namespace App\Exports;

use App\Models\UserFrontier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminUserFrontierExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
        return UserFrontier::select(
            'id',
            'corp_id',
            'address',
            'billing_TN',
            'order_number',
            'install_T_T_Soc_TTC',
            'ont_Ntd',
            'comp_or_refer',
            'billing_code',
            'qty',
            'description',
            'rate',
            'total_billed',
            'aerial_buried',
            'fiber',
            'closeout_notes',
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
            'ID', 'Corp ID', 'Address', 'Billing TN', 'Order Number', 'Install T.T. Soc TTC', 
            'ONT NTD', 'Comp or Refer', 'Billing Code', 'Qty', 'Description', 'Rate', 
            'Total Billed', 'Aerial Buried', 'Fiber', 'Closeout Notes', 'In', 'Out', 
            'Hours', 'Created At', 'Updated At'
        ];
    }
}
