<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AVITA INDIA | Request Portal</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

   
    <style>
      
      html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
      }
      
      .full-height {
        height: 100vh;
      }
      
      .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
      }
      
      .position-ref {
        position: relative;
      }
      
      .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
      }
      
      .content {
        text-align: center;
        padding-top:15%;
      }
      
      .title {
        font-size: 84px;
      }
      
      .links > a {
        color: rebeccapurple;
        padding: 15px 40px;
        margin: 21px;
        font-size: 17px;
        font-weight: 700;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        border-radius:25px;
        border:2px solid rebeccapurple;  
      }
      
      
      
      .links > a:hover {
        color: white;
        background-color:rebeccapurple;
        padding: 15px 40px;
        margin: 21px;
        font-size: 17px;
        font-weight: 700;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        border:2px solid rebeccapurple;  
      }
      
      
      .m-b-md {
        margin-bottom: 30px;
      }
      
              </style>
 </head>
 <body>
 <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
              
                    <img src="{{ asset('images/logo.png') }}" style="width:75px;">
              
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                       <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Auth::guard('admin')->check())
                               {{Auth::guard('admin')->user()->name}}
                            @elseif(Auth::guard('client')->check())
                              {{Auth::guard('client')->user()->name}}
                            @endif
                            <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                             

                                 <a class="dropdown-item" href="{{ url('new_ticket') }}">
                                    {{ __('New Ticket') }}
                                </a>
                                @if(Auth::guard('admin')->check())
                            
                               <a class="dropdown-item" href="{{ url('show_ticket') }}">
                                
                                    {{ __('Tickets') }}
                                </a>
                                
                              @elseif(Auth::guard('client')->check())

                                <a class="dropdown-item" href="{{ url('view_ticket') }}">

                                  {{ __('Tickets') }}
                                </a>
                                @endif
                                <a class="dropdown-item" href="{{ url('view_revision') }}">
                                
                                {{ __('Revisions') }}
                               </a>
                               <a class="dropdown-item" href="{{ url('view_edit') }}">
                               {{ __('Edits') }}
                               </a>
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>


                            </div>

                            
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

  <div class="container">    
     <br />
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="ticket_table">
     <thead>
      <tr>
       <th>Date</th>
       <th>SRN</th>
       <th>Brand</th>
       <th>Project Title</th>
       <th>Category</th>
       <th>Priority</th>
       <th>
       <select name="status_filter" id="status_filter" class="form-control">
         <option value="">Select Status</option>
             @foreach($statuses as $status)
         <option value="{{ $status->name }}">{{ $status->name }}</option>
             @endforeach
        </select>
       </th>
       <th>  <a href="{{ route('ticket.detail', $ticket->no) }}" class="btn btn-primary">View</a></th>
      </tr>
     </thead>
    </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html>


<script>
$(document).ready(function(){

 fetch_data();

 function fetch_data(status = '' )
 {
  $('#ticket_table').DataTable({
   processing: true,
   serverSide: true,
   ajax: {
    url:"{{ route('show_ticket.index') }}",
    data: {
            status:status
         }
   },
   columns:[
    {
     data: 'created_at',
     name: 'created_at'
    },
    {
     data: 'no',
     name: 'no'
    },
    {
     data: 'brand',
     name: 'brand',
    },
    {
     data: 'title',
     name: 'title',
    },
    {
     data: 'name',
     name: 'name',
    },
    {
     data: 'priority',
     name: 'priority',
    },
    {
     data:'status',
     name:'status',
     orderable: false
    }
   ]
  });
 }


  $('#status_filter').change(function(){
  var status = $('#status_filter').val();
  $('#ticket_table').DataTable().destroy();
  fetch_data(status);
 });

});
</script>