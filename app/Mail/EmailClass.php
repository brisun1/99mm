<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailClass extends Mailable
{
    use Queueable, SerializesModels;
    public $content;
    public $ename;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content,$topic,$ename)
    {
        $this->content=$content;
        $this->topic=$topic;
        $this->ename=$ename;
        $this->subject('99 meimei.com');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.'.$this->content)

                    ->with('ename', $this->ename)->with('topic', $this->topic);
    }
}
