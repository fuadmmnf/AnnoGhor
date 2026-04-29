<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f5f5f5;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>AnnoGhor</h1>

    <p>
        {{ $siteSettings->site_address }} <br>
        {{ $siteSettings->site_phone }} <br>
        {{ $siteSettings->site_email }}
    </p>

    <hr>

    <table>
        <tr>
            <td>
                <strong>Bill To:</strong><br>
                {{ $order->user->name ?? 'Guest User' }}<br>
                {{ $order->full_address }}<br>
                {{ $order->email }}<br>
                {{ $order->phone }}
            </td>

            <td class="text-end">
                <strong>Invoice No:</strong> EC000{{ $order->id }}<br>
                <strong>Order ID:</strong> {{ $order->order_number }}<br>
                <strong>Date:</strong> {{ $order->created_at->format('d/m/Y') }}
            </td>
        </tr>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th class="text-center">Price</th>
                <th class="text-center">Qty</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-center">${{ $item->price }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">${{ $item->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <table>
        <tr>
            <td><strong>Payment:</strong> {{ $order->payment_method }}</td>
            <td class="text-end">
                <strong>Total:</strong> ${{ $order->total_amount }}
            </td>
        </tr>
    </table>

</body>

</html>
