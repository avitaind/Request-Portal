@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        <table class="table table-hover">
                <tr>
                    <th scope="col">Job No:</th>
                    <td>ADNESEA{{ $num = sprintf('%03d', intval($ticket_detail->no))}}</td>
                </tr>
                     
                <tr>
                  
                 <th scope="col">Brand:</th>
                    <td>{!! $ticket_detail->brand !!}</td>
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
                <td>{!! $ticket_detail->priority !!}</td>
                </tr>
                     
                <tr>
                  
                 <th scope="col">Summary:</th>
                 <td>{!! $ticket_detail->summary !!}</td>
                 </tr>
               
                 <tr>
                    <th scope="col">Objective:</th>
                <td>{!! $ticket_detail->objective !!}</td>
                </tr>

                
                <tr>
                 <th scope="col">Other Information:</th>
                <td>{!! $ticket_detail->otherinfo !!}</td>
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