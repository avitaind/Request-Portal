<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class ShowTicketController extends Controller
{
    //
   function index(Request $request)
    {
     if(request()->ajax())
     {
      if($request->status)
      {
       $data = DB::table('tickets')
         ->join('categories', 'categories.name', '=', 'tickets.category_name')
         ->select('tickets.created_at', 'tickets.no',  'tickets.brand',  'tickets.title', 'categories.name',  'tickets.priority','tickets.status')
         ->where('tickets.status', $request->status);
    
      }
      else
      {
       $data = DB::table('tickets')
         ->join('categories', 'categories.name', '=', 'tickets.category_name')
         ->select('tickets.created_at', 'tickets.no',  'tickets.brand',  'tickets.title', 'categories.name',  'tickets.priority','tickets.status');
      }

      return datatables()->of($data)->make(true);
     }

    $statuses = DB::table('statuses')
        ->select("*")
        ->get();

    $tickets = DB::table('tickets')
        ->select("*")
        ->get();

     return view('show_ticket', compact('statuses','tickets'));
     
    }

}
