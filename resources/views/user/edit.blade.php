@extends('...layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">Edit User Information:</div>

                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                    {{Session::get('flash_message')}}
                    </div>
                @endif

                @if (count($errors))
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="/user/edit" method="POST">
                {{method_field('PATCH')}}

                {{ csrf_field() }}

                <div class="panel-body">
                    <li class="list-group-item">
                        ID:
                        @unless(empty($user->id))
                            {{$user->id}}
                        @endunless
                    </li>

                    <li class="list-group-item">
                        Name:
                        <textarea name="name" class="form-control">{{$user->name}}</textarea>
                    </li>

                    <li class="list-group-item">
                        Email:
                        <textarea name="email" class="form-control">{{$user->email}}</textarea>
                    </li>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                    </div>
                    </form>

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
