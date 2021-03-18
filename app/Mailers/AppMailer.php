<?php
namespace App\Mailers;

use App\Ticket;
use App\Revision;
use App\Edit;
use App\Rejection;
use Illuminate\Contracts\Mail\Mailer;
use App\Client;
use App\Admin;
use DB;

class AppMailer {
    protected $mailer; 
    protected $fromAddress = 'contact@avita-india.com';
    protected $fromName = 'Service Request | NEXSTGO South East Asia';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    //ticket information

    public function sendTicketInformation($user, Ticket $ticket)
    {
        //$this->to = $user->email;

        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();
      
        $num = sprintf('%03d', intval($number->no));


        $this->to = ['aman.sharma@ashplan.media','info@ashplan.media','abhishek.lamba@nexstgo.com','sandeep.rawat@ashplan.media','saikat.bhukta@ashplan.media','abhilasha.prabha@nexstgo.com'];
        $this->subject = "[SRN $ticket->job$num] $ticket->title";
        $this->view = 'emails.ticket_info';
        $this->data = compact('user', 'ticket');

        return $this->deliver();
    }

    public function sendTicketComments($ticketOwner, $user, Ticket $ticket, $comment)
    {
        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();
      
        $num = sprintf('%03d', intval($ticket->no));

        $this->to = ['sandeep.rawat@ashplan.media'];
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->job$num)";
        $this->view = 'emails.ticket_comments';
        $this->data = compact('ticketOwner', 'user', 'ticket', 'comment');
        return $this->deliver();
    }

    public function sendTicketStatusNotification($ticketOwner, Ticket $ticket)
    {
        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();
      
        $num = sprintf('%03d', intval($ticket->no));


        $this->to = ['sandeep.rawat@ashplan.media'];
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->job$num)";
        $this->view = 'emails.ticket_status';
        $this->data = compact('ticketOwner', 'ticket');
 
        return $this->deliver();
    }


    //Ticket Update information
    public function sendStatusInformation($user)
      {
        $ticket = Ticket::first();

        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();
      
      
        $num = sprintf('%03d', intval($number->no));
        $this->to = ['contact@ashplan.media'];
        $this->subject = "[SRN $ticket->job$num] $ticket->title";
        $this->view = 'emails.status_info';
        $this->data = compact('user', 'ticket');

        return $this->deliver();
    
        }


    //revision

    public function sendRevisionInformation($user, Revision $revision)
    {
        $number = DB::table('revisions')
        ->orderBy('created_at','desc')
        ->first();
      
       $num = sprintf('%02d', intval($number->id));

       $this->to = ['aman.sharma@ashplan.media','info@ashplan.media','abhishek.lamba@nexstgo.com','sandeep.rawat@ashplan.media','saikat.bhukta@ashplan.media','abhilasha.prabha@nexstgo.com'];
       $this->subject = "[REVISION ADNESEA$number->jobno-R$num] $revision->title";
       $this->view = 'emails.revision_info';
       $this->data = compact('user', 'revision');

       return $this->deliver();
    }


    //edits

    public function sendEditInformation($user, Edit $edit)
    {
        $number = DB::table('edits')
        ->orderBy('created_at','desc')
        ->first();
      
       $num = sprintf('%02d', intval($number->id));

       $this->to = ['aman.sharma@ashplan.media','info@ashplan.media','abhishek.lamba@nexstgo.com','sandeep.rawat@ashplan.media','saikat.bhukta@ashplan.media','abhilasha.prabha@nexstgo.com'];
       $this->subject = "[EDIT ADNESEA$number->jobno-E$num] $edit->title";
       $this->view = 'emails.edit_info';
        $this->data = compact('user', 'edit');

        return $this->deliver();
    }
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message) {
            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject);
        });
    }

    public function sendRejectionInformation($user, Rejection $rejection)
    {
        $ticket = Ticket::first();
        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();      
      
        $num = sprintf('%03d', intval($number->no));
        $this->to = ['info@ashplan.media'];
        $this->subject = "[SRN $ticket->job$num] $ticket->title";
        $this->view = 'emails.rejection_info';
        $this->data = compact('user', 'rejection');
 
         return $this->deliver();

    }
}