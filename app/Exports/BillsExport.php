<?php

namespace App\Exports;

use App\Models\Bill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BillsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Bill::with(['entity', 'billItems', 'payments']);

        if (!empty($this->filters['entity_type'])) {
            $query->where('entity_type', $this->filters['entity_type']);
        }

        if (!empty($this->filters['entity_id'])) {
            $query->where('entity_id', $this->filters['entity_id']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['date_from'])) {
            $query->where('issued_date', '>=', $this->filters['date_from']);
        }

        if (!empty($this->filters['date_to'])) {
            $query->where('issued_date', '<=', $this->filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Bill Number',
            'Entity Name',
            'Entity Type',
            'Billing Period Start',
            'Billing Period End',
            'Issued Date',
            'Due Date',
            'Subtotal',
            'Tax Amount',
            'Total Amount',
            'Total Paid',
            'Remaining Balance',
            'Status',
            'Applications Count',
            'Payment Method',
            'Payment Reference',
        ];
    }

    public function map($bill): array
    {
        return [
            $bill->bill_number,
            $bill->entity->name ?? 'N/A',
            ucfirst(str_replace('_', ' ', $bill->entity_type)),
            $bill->billing_period_start->format('Y-m-d'),
            $bill->billing_period_end->format('Y-m-d'),
            $bill->issued_date->format('Y-m-d'),
            $bill->due_date->format('Y-m-d'),
            number_format($bill->subtotal, 2),
            number_format($bill->tax_amount, 2),
            number_format($bill->total_amount, 2),
            number_format($bill->total_paid, 2),
            number_format($bill->remaining_balance, 2),
            ucfirst($bill->status),
            $bill->billItems->count(),
            $bill->payment_method ?? '',
            $bill->payment_reference ?? '',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}