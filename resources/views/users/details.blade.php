@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')
@include('revisions.index')
@include('edits.index')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @include('includes.revision')

            <table class="table table-hover">
                         <tr>
                             <th scope="col">Date:</th>
                             <td>{{ date('d/m/Y h:i:s a', strtotime($ticket->created_at)) }} </td>
                         </tr>
                        <tr>
                             <th scope="col">SRN:</th>
                             <td>ADNESEA{{ $num = sprintf('%03d', intval($ticket->no))}}</td>
                         </tr>
               
                        <tr>
                            <th scope="col">Brand:</th>
                            <td>{{ ucfirst(trans($ticket->brand)) }}</td>
                        </tr>
                        
                        <tr>
                            <th scope="col">Country:</th>
                            <td>{{ ucfirst(trans($ticket->country)) }}</td>
                        </tr>
                        
                         <tr>
                            <th scope="col">Title:</th>
                            <td>{!! $ticket->title !!}</td>
                         </tr>
                         <tr>
                             <th scope="col">Category:</th>
                             <td>{!! $ticket->category_name !!}</td>
                         </tr>
               
                        <tr>
                            <th scope="col">Priority:</th>
                            <td>{{ ucfirst(trans($ticket->priority)) }}</td>
                        </tr>
                        
                        <tr>
                            <th scope="col">Summary:</th>
                            <td>{!!  nl2br($ticket->summary) !!}</td>
                         </tr>
                         <tr>
                             <th scope="col">Objective:</th>
                             <td>{!! $ticket->objective !!}</td>
                         </tr>
               
               
                        <tr>
                        @if($ticket->reference!='')
                        
                        <th scope="col">Reference:</th>
                        
                        <td><a href="{{ '/'.$ticket->reference}}" target="_blank" download="{!! $ticket->reference !!}">Download File</a></td>
                            @else
                            <th scope="col">Reference:</th>
                            <td>N/A</td>

                            @endif
                        </tr>
                        
                         <tr>
                            <th scope="col">Other Information:</th>
                            <td>{!! $ticket->otherinfo !!}</td>
                         </tr>
                       

               <!--- form  --->


                 <tr>
                 <th scope="col">Deadline:</th>
                <td>{!! $ticket->deadline !!}</td>
                 </tr>

                 
                  <tr>
                    <th scope="col">Status:</th>
                     <td>{!! $ticket->status !!}</td>
                  </tr>

          <!--- form  --->
             <tr>
               <th scope="col">Creative for Approval:</th>
               <td>
               <div class="row justify-content-center">
               <div class="col-md-6">
               @if($ticket->creative!='')
                        
               <a href="{{ '/'.$ticket->creative}}" target="_blank" download="{!! $ticket->creative !!}">Download Creative</a>
               </div>
               <div class="col-md-6">
              <div class="modal-footer">
                <span class="pull-left">
                       <form method="POST" role="form" action="{{ route('approve', $ticket->no) }}">
                          <input type="hidden" name="id" value="{{ $ticket->no }}">
                           @csrf
                             <button type="submit" class="btn btn-success">Approve</button>
                       </form>
                </span>
                <span class="pull-right">
                 <form method="POST" role="form" action="{{ route('reject', $ticket->no) }}">
                 @csrf
                   <input type="hidden" name="id" value="{{ $ticket->no}}">
                  <button type="submit" class="btn btn-danger">Reject</button>
                 </form>
               </span>
            </div>
            
    
            </div>
                     
          </div>
          @else
               <span>N/A</span>
               @endif
       </td>
    </tr>
           <tr>
             <td>
                </td>
                   <td>
                 <div class="row justify-content-center">
              
                <div class="col-md-8">

                 @if($ticket->status=='closed')

              
                    <a class="nav-link btn btn-primary" style="cursor: pointer; color:#fff;" data-toggle="modal" data-target="#revisionModal">{{ __('Request Review') }}</a>
                
                  @else
                
                    <a class="nav-link btn btn-primary" style="cursor: pointer; color:#fff;" data-toggle="modal" data-target="#editModal">{{ __('Request Edits') }}</a>
                
                  @endif
                  </div>
                  </div>
                 </td>
                 
                 </tr>
              
          </table>
          <hr>
 
 @include('tickets.comments')

 <hr>

 @include('tickets.reply')
           </div>


      </div>

    </div>     
  @endsection