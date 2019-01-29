@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <form class="form-inline">
                    <div class="col-lg-6" style="float:left">
                        <h1><span class="fas fa-dolly-flatbed" aria-hidden="true"></span>  Order</h1><br>
                    </div>
                    
                </form>
            </div>
            <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    {{-- @if(count($orders) > 0)
                                        @foreach ($orders as $order) --}}
                                        <tr>
                                            <td class="align-middle">Faisal rizky Rahadian</td>
                                            <td class="align-middle">Komputer Asus</td>
                                            <td class="align-middle">Rp 100000, 0)}}</td>
                                            <td class="align-middle">2 pcs</td>
                                            <td class="align-middle">Rp 200000, 0)}}</td>
                                            <td class="align-middle">28 Januari 2-18</td>
                                            {{-- @if($order->status==1) --}}
                                                <td class="align-middle">Sudah Dibayar</td>
                                            {{-- @else --}}
                                                <td class="align-middle">Belum Dibayar</td>
                                            {{-- @endif  --}}
                                            
                                        </tr>
                                        {{-- @endforeach
                                    @else
                                        <h3>No posts found!</h3>
                                    @endif --}}
                            </tbody>
                        </table>
                        <div class="col-lg-6 offset-6">
                                <a href="" type="submit" class="btn btn-primary" style="float:right">Bayar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@endsection