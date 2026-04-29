<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Restock Report</title>
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

    <h2>Restock Report ({{ ucfirst($range) }})</h2>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Day</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Added Qty</th>
                <th>Opening Stock</th>
                <th>Closing Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['date'] }}</td>
                    <td>{{ $item['day'] }}</td>
                    <td>{{ $item['product_code'] }}</td>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['total_added'] }}</td>
                    <td>{{ $item['opening_stock'] }}</td>
                    <td>{{ $item['closing_stock'] }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4" style="text-align: right;">
                    <strong>Total Restocked Quantity</strong>
                </td>
                <td colspan="3">
                    <strong>{{ $totalRestockQty }}</strong>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
