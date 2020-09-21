@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')

<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-10">
           <div class="panel-body">
           @include('includes.flash')
                  <form class="form-horizontal" role="form" action="/update/{{  $ticket_detail->no }}" method="POST" enctype="multipart/form-data">
                   {!! csrf_field() !!}

                 <table class="table table-hover">
                       <tr>
                             <th scope="col">Date: </th>
                             <input type="hidden" name="user_name" value="{!! Auth::guard('admin')->user()->name !!}">
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
                            <td>{!! nl2br($ticket_detail->summary) !!}</td>
                         </tr>
                         <tr>
                             <th scope="col">Objective:</th>
                             <td>{!! $ticket_detail->objective !!}</td>
                         </tr>
               
                        <tr>
                        @if($ticket_detail->reference!='')
                        
                        <th scope="col">Reference:</th>
                        
                        <td>                        
                        <a href="{{ '/'.$ticket_detail->reference}}" target="_blank" download="{!! $ticket_detail->reference !!}">Download File</a>
                         </td>
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
                            <td>
                            <div class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">

                            <input id="deadline" type="date" class="form-control" name="deadline" value="{{ old('deadline') }}">
                                @if ($errors->has('deadline'))
                                    <span class="help-block">
                                    <strong><span class="error">Deadline Can Not Be Empty</span></strong>
                                    </span>
                                @endif
                            </div>
                          </td>
                        </tr>
                        
                         <tr>
                            <th scope="col">Status:</th>
                            <td>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <select id="status" type="status" class="form-control" name="status">
                            <option value="">--- Select --- </option>
                               <option value="open">Open</option>
                               <option value="processing">Processing</option>
                               <option value="pending">Pending (from Client)</option>
                               <option value="closed">Closed</option>
                             </select>
                              @if ($errors->has('status'))
                                    <span class="help-block">
                                    <strong><span class="error">Job Status Can Not Be Empty</span></strong>
                                    </span>
                                @endif
                            
                               </div>
                            </td>
                         </tr>
                         @if($ticket_detail->creative_status!='')
                         <tr>
                            <th scope="col">Creative Status:</th>
                            <td>
                            {!! $ticket_detail->creative_status !!}
                            </td>
                          </tr>
                         @else
                         <tr>
                         
                            <th scope="col">Creative for Approval:</th>
                            <td>
                            <div class="form-group{{ $errors->has('creative') ? ' has-error' : '' }}">
                            <label for="creative" class="col-md-10 control-label">Upload Creative for Client Approval</label>
                            <div class="col-md-10">
                                <input id="creative" type="file" class="form-control" name="creative" value="{{ old('creative') }}">
                                <p class="files">Supported file format: jpg, jpeg, png, pdf, xlsx, xlx, ppt, pptx, csv, zip</p>    
                               @if ($errors->has('reference'))
                                    <span class="help-block">
                                    <strong><span class="error">{{ $errors->first('creative') }}</span></strong>
                                    </span>
                                @endif
                                
                                 </div>
                              </div>
                            </td>
                         </tr>
                    @endif

                         <tr>
                            <td>
                            
                            </td>
                         <td>
                             <div class="form-group">
                                 <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Update Details
                                </button>
                             </div>
                             
                             </td>
                        </tr>
                
                </table>
                </form>
               
                <hr>
 
        @include('tickets.comments')

        <hr>

        @include('tickets.reply')

             </div>   
          </div>
        </div>
    </div>
@endsection