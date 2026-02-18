<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #2E2E2C;
            line-height: 1.6;
        }
        
        .header {
            background: linear-gradient(135deg, #E8521A 0%, #4A6741 100%);
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 5px;
        }
        
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 12px;
            opacity: 0.9;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            background-color: #E8521A;
            color: white;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            border-radius: 3px;
        }
        
        .metrics {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .metric {
            display: table-cell;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            width: 25%;
        }
        
        .metric-value {
            font-size: 18px;
            font-weight: bold;
            color: #E8521A;
        }
        
        .metric-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        
        .metric-change {
            font-size: 11px;
            margin-top: 5px;
            padding: 3px 6px;
            border-radius: 3px;
            display: inline-block;
        }
        
        .metric-change.positive {
            background-color: #d4edda;
            color: #155724;
        }
        
        .metric-change.negative {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th {
            background-color: #E8521A;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
        }
        
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #E8521A;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PetZone Analytics Report</h1>
        <p>Sales & Performance Analysis - {{ now()->format('F Y') }}</p>
    </div>

    <!-- Revenue Metrics -->
    <div class="section">
        <div class="section-title">📊 REVENUE METRICS</div>
        <div class="metrics">
            <div class="metric">
                <div class="metric-label">Current Month Revenue</div>
                <div class="metric-value">৳{{ number_format($currentMonthRevenue, 2) }}</div>
                <div class="metric-change {{ $revenueChange >= 0 ? 'positive' : 'negative' }}">
                    {{ $revenueChange >= 0 ? '↑' : '↓' }} {{ abs(round($revenueChange, 2)) }}%
                </div>
            </div>
            <div class="metric">
                <div class="metric-label">Previous Month Revenue</div>
                <div class="metric-value">৳{{ number_format($previousMonthRevenue, 2) }}</div>
            </div>
            <div class="metric">
                <div class="metric-label">Orders Count</div>
                <div class="metric-value">{{ $currentMonthOrders }}</div>
                <div class="metric-change {{ $ordersChange >= 0 ? 'positive' : 'negative' }}">
                    {{ $ordersChange >= 0 ? '↑' : '↓' }} {{ abs(round($ordersChange, 2)) }}%
                </div>
            </div>
            <div class="metric">
                <div class="metric-label">Average Order Value</div>
                <div class="metric-value">৳{{ number_format($currentMonthAOV, 2) }}</div>
                <div class="metric-change {{ $aovChange >= 0 ? 'positive' : 'negative' }}">
                    {{ $aovChange >= 0 ? '↑' : '↓' }} {{ abs(round($aovChange, 2)) }}%
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="section">
        <div class="section-title">🏆 TOP 5 SELLING PRODUCTS</div>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity Sold</th>
                    <th>Total Revenue</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->total_quantity }}</td>
                    <td>৳{{ number_format($product->total_revenue, 2) }}</td>
                    <td>৳{{ number_format($product->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Sales by Status -->
    <div class="section">
        <div class="section-title">📈 SALES BY STATUS</div>
        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Number of Orders</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesByStatus as $status)
                <tr>
                    <td><strong>{{ ucfirst($status->status) }}</strong></td>
                    <td>{{ $status->count }}</td>
                    <td>৳{{ number_format($status->revenue, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>

    <!-- Daily Sales -->
    <div class="section">
        <div class="section-title">📅 DAILY SALES - {{ now()->format('F Y') }}</div>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Orders</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dailySales as $day)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($day->date)->format('F d, Y') }}</td>
                    <td>{{ $day->orders }}</td>
                    <td>৳{{ number_format($day->revenue, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Report Generated: {{ now()->format('F d, Y H:i A') }}</p>
        <p>PetZone - Online Pet Food Shop</p>
    </div>
</body>
</html>
