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
                  
                 <th scope="col">Reference:</th>
                  <td><a href="{{ '/uploads/'.$ticket_detail->reference}}" target="_blank" download="{!! $ticket_detail->reference !!}">Download File</a></td>
                 </tr>

                <tr>
                 <th scope="col">Other Information:</th>
                <td>{!! $ticket_detail->otherinfo !!}</td>
                 </tr>


                 @include('includes.flash')
                <form class="form-horizontal" role="form" action="/update/{{ $ticket_detail->no }}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}

                 <tr>
                 <th scope="col">Deadline:</th>
                 <td>
                 <div class="form-group{{ $errors->has('brand') ? ' has-error' : '' }}">
                 <div class="col-md-6">
                 <input id="deadline" type="date" class="form-control" name="deadline" value="{{ old('deadline') }}">
                 @if ($errors->has('deadline'))
                        <span class="help-block">
                       <strong><span class="error">Please input a date</span></strong>
                     </span>
                   @endif
                 </div>
                 </td>
                 </tr>
                
                <tr>
                 <th scope="col">Status:</th>
                 <td> 
                 <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                     <div class="col-md-6">
                      <select id="status" type="status" class="form-control" name="status">
                          <option value="">--- Select --- </option>
                               <option value="open">Open</option>
                               <option value="processing">Under Process</option>
                               <option value="pending">Pending (from Client)</option>
                               <option value="closed">Closed</option>
                        </select>
                              @if ($errors->has('status'))
                                    <span class="help-block">
                                    <strong><span class="error">Job Status Can Not Be Empty</span></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                 
                 
                 </td>
                 </tr>
                 <tr>
                 <td></td>
                 <td>
                 <div class="col">
                          <button type="submit" class="btn btn-primary">
                          <i class="fa fa-btn fa-ticket"></i>Update Request
                      </button>
                  </div>
                 </td>
                 </tr>
               
            
         </table>

         










        </div>
      </div>

    </div>     
  @endsection