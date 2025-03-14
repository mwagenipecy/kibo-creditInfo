<?php

namespace App\Exports;

use App\Models\ClientsModel;
use App\Models\general_ledger;
use App\Models\loans_schedules;
use App\Models\LoansModel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

class LoanRepayment implements FromArray,WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function array():array
    {
        // create an array to return
        // get client name
        $client_name=LoansModel::whereIn('loan_account_number',$this->value)->value('client_number');

        $client_full_name=ClientsModel::where('client_number',$client_name)->first();
        $client_full_name=$client_full_name->first_name.' '.$client_full_name->middle_name.' '.$client_full_name->last_name;

        $data=array();
        $transaction_records=[];
        foreach ( $this->value as $value){

            $transaction_records[]= general_ledger::where('record_on_account_number', $value)->get();

        }



       foreach ($transaction_records as $values){

           foreach ($values as $value) {
               $data[] = [
                   'created_at' => $value->created_at->format('Y-m-d'),
                   'client_full_name' => $client_full_name,
                   'loan_id' => $value->loan_id,
                   'debit' => $value->debit ?:"00",
                   'credit' => $value->credit ?:"00",
                   'narration' => $value->narration,
                   'record_on_account_number' => $value->record_on_account_number,
                   'record_on_account_number_balance' => $value->record_on_account_number_balance ? :"00",



               ];
           }

       }

        return $data;

    }

    public function headings(): array
    {
        return [
            'Created At',
            'Client Full Name',
            'Loan ID',
            'Debit (TZS)',
            'Credit (TZS)',
            'narration',
            'Account Number',
            'Account Balance(TZS)',

        ];
    }

    public function styles(Worksheet|\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFF00']],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'color' => ['argb' => 'FF0000'],
                    ],
                ]);
            },
        ];
    }
}
