<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $pdfPath;

    public function __construct(Order $order, string $pdfPath)
    {
        $this->order   = $order;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this
            ->subject('Su factura para el pedido #' . $this->order->id)
            ->markdown('emails.invoices.new', [
                'order' => $this->order,
            ])
            ->attach(storage_path('app/public/' . $this->pdfPath), [
                'as'   => 'factura_pedido_' . $this->order->id . '.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
