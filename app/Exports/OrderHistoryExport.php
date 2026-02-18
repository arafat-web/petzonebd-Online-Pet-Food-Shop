<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\PatternFill;
use App\Models\Orders;
use Carbon\Carbon;

class OrderHistoryExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->startOfMonth();
        $this->endDate = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfMonth();
    }

    public function collection()
    {
        return Orders::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->with('user')
            ->latest('created_at')
            ->get()
            ->map(function ($order) {
                return [
                    $order->order_number,
                    $order->user->name,
                    $order->user->email,
                    $order->total,
                    ucfirst($order->status),
                    ucfirst($order->payment_method),
                    $order->created_at->format('F d, Y H:i A'),
                ];
            });
    }

    public function headings(): array
    {
        return ['Order Number', 'Customer Name', 'Email', 'Total Amount (৳)', 'Status', 'Payment Method', 'Order Date'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1:1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('1:1')->getFill()->setFillType(PatternFill::FILL_SOLID)->getStartColor()->setARGB('FFE8521A');
        $sheet->getStyle('1:1')->getFont()->getColor()->setARGB('FFFFFFFF');

        return [];
    }
}
