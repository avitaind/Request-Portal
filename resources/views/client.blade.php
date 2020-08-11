@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="title m-b-md">
                    <img src="{{ asset('images/logo.png') }}" style="width:350px;">
                </div>
                </div>
                <div class="flex-center position-ref">
                <div class="center-center links">
                        <a href="{{ url('new_ticket') }}">Create Request</a>
                        <a href="{{ url('view_ticket') }}">View Request</a>
                    </div>
                </div>
            </div>
        </div>

</div>

@endsection