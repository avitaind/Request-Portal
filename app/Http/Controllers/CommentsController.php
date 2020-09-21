<?php

namespace App\Http\Controllers; 
use App\Comment;
use App\User;
use App\Admin;
use App\Client;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class CommentsController extends Controller
{
    public function postComment(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'comment' => 'required',

        ]);
 
        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_name' => $request->input('user_name'),
            'comment' => $request->input('comment')
        ]);
 
        // send mail if the user commenting is not the ticket owner
        
      /*  if($comment->ticket->user->name !== $request->input('user_name')) {
            $mailer->sendTicketComments($comment->ticket->user, $request->input('user_name'), $comment->ticket, $comment);
        }
        */
        return redirect()->back()->with("status", "Your comment has be submitted.");
    }
}