<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class ViewTicketController extends Controller
{
   function index(Request $request)
   {
    if(request()->ajax())
    {
     if($request->status)
     {
      $data = DB::table('tickets')
        ->join('categories', 'categories.name', '=', 'tickets.category_name')
        ->select('tickets.no', 'tickets.title', 'categories.name', 'tickets.status')
        ->where('tickets.status', $request->status);
     }
     else
     {
      $data = DB::table('tickets')
        ->join('categories', 'categories.name', '=', 'tickets.category_name')
        ->select('tickets.no', 'tickets.title', 'categories.name', 'tickets.status');
     }

     return datatables()->of($data)->make(true);
    }

   $statuses = DB::table('statuses')
       ->select("*")
       ->get();

    return view('view_ticket', compact('statuses'));
    
   }

}
