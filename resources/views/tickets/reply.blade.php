<div class="panel panel-default">
    <div class="panel-heading">Add Reply</div>
 
        <div class="panel-body">
            <div class="comment-form">
 
                <form action="{{ url('comment') }}" method="POST" class="form">
                    {!! csrf_field() !!}
 
                    <input type="hidden" name="ticket_id" value="{{ $ticket_detail->no }}">
                       @if(Auth::guard('admin')->check())
                      <input type="hidden" name="user_name" value="{{Auth::guard('admin')->user()->name}}">
                        @elseif(Auth::guard('client')->check())
                           <input type="hidden" name="user_name" value="{{Auth::guard('client')->user()->name}}">
                        @endif

                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        <textarea rows="2" id="comment" class="form-control" name="comment"></textarea>
                       
                        @if ($errors->has('comment'))
                            <span class="help-block">
                               <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                        @endif
                    </div>
 
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
</div>