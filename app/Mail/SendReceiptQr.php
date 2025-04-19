<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendReceiptQr extends Mailable
{
    use Queueable, SerializesModels;

    public $receipt;
    public $qrUrl;

    public function __construct($receipt, $qrUrl)
    {
        $this->receipt = $receipt;
        $this->qrUrl = $qrUrl;
    }

    public function build()
    {
        $qr = base64_encode(QrCode::format('png')->size(200)->generate($this->qrUrl));

        return $this->subject('QR Code Konfirmasi Reservasi')
            ->view('emails.receipt')
            ->with(['receipt' => $this->receipt, 'qr' => $qr]);
    }
}