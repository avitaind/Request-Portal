<?php
namespace App\Mailers;

use App\Ticket;
use Illuminate\Contracts\Mail\Mailer;
use App\Client;
use DB;

class AppMailer {
    protected $mailer; 
    protected $fromAddress = 'contact@avita-india.com';
    protected $fromName = 'Request Portal | Ticket';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTicketInformation($user, Ticket $ticket)
    {
        //$this->to = $user->email;

        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();
      
        $num = sprintf('%03d', intval($number->no));


        $this->to = ['aman.sharma@ashplan.media','info@ashplan.media'];
        $this->subject = "[Ticket ID: $ticket->job$num] $ticket->title";
        $this->view = 'emails.ticket_info';
        $this->data = compact('user', 'ticket');

        return $this->deliver();
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message) {
            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject);
        });
    }
}