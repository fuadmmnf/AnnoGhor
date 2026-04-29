<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sell Report</title>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Sell Report ({{ ucfirst($range) }})</h2>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Day</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Total Sold Qty</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['date'] }}</td>
                    <td>{{ $item['day'] }}</td>
                    <td>{{ $item['product_code'] }}</td>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['total_qty'] }}</td>
                    <td>{{ number_format($item['total_amount'], 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: right;"><strong>Total Sell Amount</strong></td>
                <td><strong>{{ number_format($totalSellAmount, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

</body>

</html>
