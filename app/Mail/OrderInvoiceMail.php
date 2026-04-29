<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $siteSettings;

    public function __construct(Order $order, $siteSettings)
    {
        $this->order = $order;
        $this->siteSettings = $siteSettings;
    }

    public function build()
    {
        $pdf = Pdf::loadView('invoices.order-invoice-pdf', [
            'order' => $this->order,
            'siteSettings' => $this->siteSettings,
        ])->setPaper('a4', 'portrait');

        return $this->subject('Invoice - ' . $this->order->order_number)
            ->view('emails.order-invoice')
            ->attachData(
                $pdf->output(),
                'invoice-' . $this->order->order_number . '.pdf'
            );
    }
}
