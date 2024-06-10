<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $requestData;

    public function __construct(Request $requestData)
    {
        $this->requestData = $requestData;
    }

    public function build()
    {
        return $this->subject('Accusé de réception de votre demande')
                    ->view('emails.request_submitted');
    }
}
