<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $requestData;

    public function __construct(Request $requestData)
    {
        $this->requestData = $requestData;
    }

    public function build()
    {
        return $this->subject('Mise à jour de votre demande')
                    ->view('emails.request_updated');
    }
}
