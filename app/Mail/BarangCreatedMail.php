<?php

namespace App\Mail;

use App\Models\Barang;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BarangCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $barang;

    public function __construct(Barang $barang)
    {
        $this->barang = $barang;
    }

    public function build()
    {
        return $this->subject('Barang Baru Ditambahkan')
                    ->view('emails.barang-created')
                    ->with([
                        'barang' => $this->barang
                    ]);
    }
}
