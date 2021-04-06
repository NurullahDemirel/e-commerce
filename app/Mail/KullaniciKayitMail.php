<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Kullanici;

class KullaniciKayitMail extends Mailable
{
    public $user;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Kullanici $kullanici)
    {
        $this->user=$kullanici;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->
        from('nurullahdemirel75@gmail.com')->
        subject('test mail')->view('email.kullanici_kayit');
    }
}
