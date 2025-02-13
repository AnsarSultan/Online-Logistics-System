@extends('adminLayout')
@section('content')
    <div class="income">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Total Freights</h6>
                            <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>{{ $totalFreights }}</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-gray order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Payment pending</h6>
                            <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>{{ $paymentPending }}</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-green order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Pending Dispatch</h6>
                            <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>{{ $pendingDispatch }}</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">In transit Freights</h6>
                            <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span>{{ $inTransit }}</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Delivered Freights</h6>
                            <h2 class="text-right"><i
                                    class="fa fa-credit-card f-left"></i><span>{{ $Delivered }}</span></h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
