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
                             <th scope="col">Date: </th>
                             <input type="hidden" name="user_name" value="{!! Auth::guard('client')->user()->name !!}">
                             <td>{{ date('d/m/Y h:i:s a', strtotime($ticket_detail->created_at)) }} </td>
                         </tr>
                        <tr>
                             <th scope="col">SRN:</th>
                             <input type="hidden" name="ticket_id" value="{!! $ticket_detail->no !!}">
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
                            <td>{!!  nl2br($ticket_detail->summary) !!}</td>
                         </tr>
                         <tr>
                             <th scope="col">Objective:</th>
                             <td>{!! $ticket_detail->objective !!}</td>
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

          <!--- form  --->
             <tr>
               <th scope="col">Creative for Approval:</th>
               <td>
               <div class="row justify-content-center">
               <div class="col-md-6">
               @if($ticket_detail->creative!='')
                        
               <a href="{{ '/'.$ticket_detail->creative}}" target="_blank" download="{!! $ticket_detail->creative !!}">Download Creative</a>
               </div>
               <div class="col-md-6">
              <div class="modal-footer">
                <span class="pull-left">
                       <form method="POST" role="form" action="{{ route('approve', $ticket_detail->no) }}">
                          <input type="hidden" name="id" value="{{ $ticket_detail->no }}">
                           @csrf
                             <button type="submit" class="btn btn-success">Approve</button>
                       </form>
                </span>
                <span class="pull-right">
                
                <form method="POST" role="form" action="{{ route('reject', $ticket_detail->no) }}">
                 @csrf
                   <input type="hidden" name="id" value="{{ $ticket_detail->no}}">
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

                 @if($ticket_detail->status=='closed')
                    <a class="nav-link btn btn-primary" style="cursor: pointer; color:#fff;" data-toggle="modal" data-target="#revisionModal">{{ __('Request Review') }}</a>
                  @else
                    <a class="nav-link btn btn-primary" style="cursor: pointer; color:#fff;" data-toggle="modal" data-target="#editModal">{{ __('Request Edits') }}</a>
                  @endif
                  </div>
                  </div>
                 </td>
                 
                 </tr>
             
                 </table>

          </div>
          
      </div>
    </div>     
  @endsection