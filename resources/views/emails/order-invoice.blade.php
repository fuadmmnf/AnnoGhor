<h2>Hello {{ $order->user->name ?? 'Customer' }}</h2>

<p>Thank you for your order.</p>

<p>
    Your order <strong>{{ $order->order_number }}</strong> has been placed successfully.
</p>

<p>
    📎 Your invoice is attached as a PDF.
</p>

<p>
    Thanks,<br>
    {{ config('app.name') }}
</p>
