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
                    <div class="panel-body">
                    <h4>Please enter the product and the price below.</h4>
                        <form action="checkout" method="post">

                            {{ csrf_field() }}

                            <li class="list-group-item">
                                 Product:
                                <input type="text" name="product" class="form-control">
                            </li>

                            <li class="list-group-item">
                                 Price:
                                <input type="text" name="price" class="form-control">
                            </li>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Purchase</button>
                            </div>
                        </form>
                    </div>
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
