<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\PatternFill;
use Carbon\Carbon;

class SalesAnalyticsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $rows = collect();

        // Add summary section
        $rows->push(['SALES ANALYTICS SUMMARY']);
        $rows->push(['Generated on', now()->format('F d, Y H:i A')]);
        $rows->push(['']);

        // Metrics section
        $rows->push(['MONTHLY METRICS']);
        $rows->push(['Metric', 'Current Month', 'Previous Month', 'Change %']);
        $rows->push(['Revenue', $this->data['currentMonthRevenue'], $this->data['previousMonthRevenue'], round($this->data['revenueChange'], 2)]);
        $rows->push(['Orders', $this->data['currentMonthOrders'], $this->data['previousMonthOrders'], round($this->data['ordersChange'], 2)]);
        $rows->push(['Average Order Value', round($this->data['currentMonthAOV'], 2), round($this->data['previousMonthAOV'], 2), round($this->data['aovChange'], 2)]);
        $rows->push(['']);

        // Top products section
        $rows->push(['TOP SELLING PRODUCTS']);
        $rows->push(['Product Name', 'Total Quantity Sold', 'Total Revenue', 'Unit Price']);
        foreach ($this->data['topProducts'] as $product) {
            $rows->push([$product->name, $product->total_quantity, $product->total_revenue, $product->price]);
        }
        $rows->push(['']);

        // Sales by status section
        $rows->push(['SALES BY STATUS']);
        $rows->push(['Status', 'Order Count', 'Revenue']);
        foreach ($this->data['salesByStatus'] as $status) {
            $rows->push([ucfirst($status->status), $status->count, $status->revenue]);
        }
        $rows->push(['']);

        // Daily sales section
        $rows->push(['DAILY SALES']);
        $rows->push(['Date', 'Orders', 'Revenue']);
        foreach ($this->data['dailySales'] as $day) {
            $rows->push([Carbon::parse($day->date)->format('F d, Y'), $day->orders, $day->revenue]);
        }

        return $rows;
    }

    public function headings(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1:1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('5:5')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('6:6')->getFont()->setBold(true)->setFill(new PatternFill('solid', 'E8521A'));
        $sheet->getStyle('6:6')->getFont()->setColor(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $sheet->getStyle('10:10')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('11:11')->getFont()->setBold(true)->setFill(new PatternFill('solid', 'E8521A'));
        $sheet->getStyle('11:11')->getFont()->setColor(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $sheet->getStyle('15:15')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('16:16')->getFont()->setBold(true)->setFill(new PatternFill('solid', 'E8521A'));
        $sheet->getStyle('16:16')->getFont()->setColor(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $sheet->getStyle('20:20')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('21:21')->getFont()->setBold(true)->setFill(new PatternFill('solid', 'E8521A'));
        $sheet->getStyle('21:21')->getFont()->setColor(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        return [];
    }
}
