<?php

namespace App\Http\Controllers;
use Auth;
use Admin;
use Client;

use DB;
use Storage;

use Illuminate\Http\Request;
use App\Category;
use App\Ticket;
use Faker\Provider\Image;
use App\Mailers\AppMailer;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class TicketsController extends Controller
{
    
    protected $guard = ['admin', 'client'];

    public function create()
    {
        $categories = Category::all();
    
        return view('users.create', compact('categories'));
    }


    public function show()
    {
        $tickets = Ticket::all();
        return view('admin.show', compact('tickets'));

    }


    public function view()
    {
        $tickets = Ticket::all();
        return view('users.view', compact('tickets'));

    }



    public function update(Request $request, $id)
    {
      
        $deadline = $request->input('deadline');
        $status = $request->input('status');
      
       DB::update('update tickets set deadline = ?, status = ? where no = ?', [$deadline, $status, $id]);
       $num = sprintf('%03d', intval($id));
       return redirect()->back()->with("status", "Your SRN no. ADNESEA$num has been updated.");

    }
   


    public function store(Request $request, AppMailer $mailer){

        $fileName="";
        $this->validate($request, [
            'brand'     => 'required',
            'title'     => 'required',
            'category'  => 'required',
            'priority'  => 'required',
            'summary'   => 'required',
            'reference' => 'mimes:jpg,jpeg,png,pdf,xlxs,xlx,ppt,pptx,csv|max:30720',
                      
        ]);
 
        if($request->hasFile('reference')){
            $image = $request->file('reference')->getClientOriginalName();
            $fileName = $request->reference->move(date('mdYHis').'uploads', $image);
            
        }
  
      $ticket = new Ticket([
             'job'     => 'ADNESEA',
             'brand'     => $request->input('brand'),
             'title'     => $request->input('title'),
             'category_name' => $request->input('category'),
             'priority'   => $request->input('priority'),
             'summary'   => $request->input('summary'),
             'objective' => $request->input('objective'),
             'reference' => $fileName,
             'otherinfo' => $request->input('otherinfo'),
         ]);
        
           
      //    $fileName = $request->file('reference')->getClientOriginalName();
       //  $request->reference->move(public_path().'/uploads', $fileName);
         $ticket->save();
         
        $mailer->sendTicketInformation(Auth::user(), $ticket);

        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();
      
       $num = sprintf('%03d', intval($number->no));
       return redirect()->back()->with("status", "A new SRN no. : $ticket->job$num has been generated.");
    }
    

    public function viewTicketDetail($slug ){

        $ticket_detail = Ticket::where('no', $slug)->get()->first();

        return view('users.details', compact('ticket_detail'));
    }



    public function showTicketDetail($slug){

        $ticket_detail = Ticket::where('no', $slug)->get()->first();

        return view('admin.details', compact('ticket_detail'));
    }

  
    public function deleteTicketDetail($slug){

        $ticket = Ticket::findOrFail($slug);
        $ticket->delete();
        return redirect()->view('view_ticket');

    }
}
