<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

	public $param;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $this->param = $param;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('RE: ' . $this->param['contact']['subject'])
			->view('emails.contact')
			->with([
				'contact' => $this->param['contact'],
				'content' => $this->param['content'],
			]);
    }
}
