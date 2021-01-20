<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->order = "Hello world";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        // return $this->from('vietthanhqt123@example.com')
        // ->view('frontend.email.checkemail')
        // ->with([
        //     'orderName' => $this->order->name,
        //     'orderPrice' => $this->order->price,
        // ]);


        Mail::send('frontend.email.checkmail', array(
            'slug' => $data['slug'],
            'content' => $data['content']
        ), function($message){
            $message->to('vietthanhqt123@gmail.com', 'dang thien bao')->subject('thienbaoit test mail!');
        });
    }
}
