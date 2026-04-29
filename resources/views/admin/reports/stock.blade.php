<!DOCTYPE html>
<html>
<head>
    <title>Stock Report</title>
    <style>
        body{font-family: sans-serif;}
        table{width:100%;border-collapse:collapse;}
        th,td{border:1px solid #ddd;padding:8px;text-align:left;}
        th{background:#f4f4f4;}
    </style>
</head>
<body>
    <h2>Stock Report</h2>
    <table>
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Stock Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->product_code }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->stock_quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
