@extends('layouts.auth')

@section('title', 'Open Ticket')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Job No</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Project Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $tickets as $ticket )
                    <tr class="table-active">
                  
                    <td>ADNESEA{{ $num = sprintf('%03d', intval($ticket->no))}}</td>
                    <td>{{ $ticket->brand }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->category_name }}</td>
                    <td>{{ $ticket->priority }}</td>
                    <td>{{ $ticket->deadline }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>
                    
                    <div class="col-md-10 col-md-offset-4">
                    <a class="event-more" href="{{ route('ticket.status', $ticket->no) }}">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> More
                     </a>
                  </div>
                    
                    </td>
                   </tr>
                    @endforeach
                </tbody>
            </thead>
         </table>

    </div> 
        <div>

            <a href="{{ url('new_ticket') }}" class="button btn btn-primary">Create New Request</a>

        </div>
  </div> 

 </div> 
 @endsection
