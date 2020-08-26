@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

     
        <table class="table table-hover">
                       <tr>
                             <th scope="col">Date:</th>
                             <td>{{ date('d-m-Y', strtotime($ticket_detail->created_at)) }}</td>
                         </tr>
                        <tr>
                             <th scope="col">Job No:</th>
                             <td>ADNESEA{{ $num = sprintf('%03d', intval($ticket_detail->no))}}</td>
                         </tr>
               
                        <tr>
                            <th scope="col">Brand:</th>
                            <td>{{ ucfirst(trans($ticket_detail->brand)) }}</td>
                        </tr>
                        
                        <tr>
                            <th scope="col">Country:</th>
                            <td>{{ ucfirst(trans($ticket_detail->country)) }}</td>
                        </tr>
                        
                         <tr>
                            <th scope="col">Title:</th>
                            <td>{!! $ticket_detail->title !!}</td>
                         </tr>
                         <tr>
                             <th scope="col">Category:</th>
                             <td>{!! $ticket_detail->category_name !!}</td>
                         </tr>
               
                        <tr>
                            <th scope="col">Priority:</th>
                            <td>{{ ucfirst(trans($ticket_detail->priority)) }}</td>
                        </tr>
                        
                         <tr>
                            <th scope="col">Summary:</th>
                            <td>{{ ucfirst(trans($ticket_detail->summary)) }}</td>
                         </tr>
                         <tr>
                             <th scope="col">Objective:</th>
                             <td>{{ ucfirst(trans($ticket_detail->objective)) }}</td>
                         </tr>
               
                        <tr>
                        @if($ticket_detail->reference!='')
                        
                        <th scope="col">Reference:</th>
                        
                        <td><a href="{{ '/'.$ticket_detail->reference}}" target="_blank" download="{!! $ticket_detail->reference !!}">Download File</a></td>
                            @else
                            <th scope="col">Reference:</th>
                            <td>N/A</td>

                            @endif
                        </tr>
                        
                         <tr>
                            <th scope="col">Other Information:</th>
                            <td>{!! $ticket_detail->otherinfo !!}</td>
                         </tr>
               

               <!--- form  --->


                 <tr>
                 <th scope="col">Deadline:</th>
                <td>{!! $ticket_detail->deadline !!}</td>
                 </tr>

                 
                <tr>
                 <th scope="col">Status:</th>
                <td>{!! $ticket_detail->status !!}</td>
                 </tr>


                 <tr>
               
                 <td>
                 
                  
                 </td>
                 <td>
                 <div class="col">
                    <a href="{{ url('view_ticket') }}" class="btn btn-primary">Back to Menu</a>
                  </div>
                  
                 </td>
                 
                 </tr>
          </table>

           </div>


      </div>

    </div>     
  @endsection