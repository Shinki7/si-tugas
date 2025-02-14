<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Mahasiswa;

class MahasiswaRegisterMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     */

    protected $mahasiswa;
    public function __construct(Mahasiswa $mahasiswa)
    {
        $this->mahasiswa = $mahasiswa;
    }

    /**
     * Get the message envelope.
     */
    public function build(){
        return $this->subject('verifikasi akun mahasiswa')
            ->view('mail.MahasiswaRegister')
            ->with([
                'mahasiswa'=>$this->mahasiswa
            ]);
    }
}
