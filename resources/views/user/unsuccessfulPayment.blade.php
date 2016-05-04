@extends('...layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">PayPal</div>
                        @if(Session::has('flash_message'))
                            <div class="alert alert-danger">
                            {{Session::get('flash_message')}}
                            </div>
                        @endif

                        <li class="list-group-item">
                        Something has gone wrong. Payment did not go through.
                        </li>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.boostrapcdn.com/boostrap/3.2.0/js/bootstrap.min.js"></script>

<script>
    $('div.alert').delay(2000).slideUp(300);
</script>
@endsection
