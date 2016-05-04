@extends('...layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">PayPal</div>
                    <div class="panel-body">
                        <h4>View Transaction History Below</h4>
                            @foreach($transactionDatabse as $transaction)
                                <ul class="list-group">

                                    <li class="list-group-item">
                                        Name:
                                        @unless(empty( Auth::user()->name ))
                                            {{ Auth::user()->name }}
                                        @endunless
                                    </li>

                                     <li class="list-group-item">
                                        Product:
                                        @unless(empty($transaction->product))
                                            {{$transaction->product}}
                                        @endunless
                                    </li>

                                    <li class="list-group-item">
                                        Price:
                                        @unless(empty($transaction->price))
                                            ${{$transaction->price}}
                                        @endunless
                                    </li>

                                    <li class="list-group-item">
                                        PayerID:
                                        @unless(empty($transaction->payer_id))
                                            {{$transaction->payer_id}}
                                        @endunless
                                    </li>

                                    <li class="list-group-item">
                                        PaymentID:
                                        @unless(empty($transaction->payment_id))
                                            {{$transaction->payment_id}}
                                        @endunless
                                    </li>

                                    <li class="list-group-item">
                                        Created At:
                                        @unless(empty($transaction->created_at))
                                            {{$transaction->created_at}}
                                        @endunless
                                    </li>

                                </ul>
                        @endforeach
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
