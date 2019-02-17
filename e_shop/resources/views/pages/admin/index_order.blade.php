@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h1><span class="fas fa-dolly-flatbed" aria-hidden="true"></span> Order</h1><br>
        <div class="table-responsive"  style="margin-top:20px">
            <table id="dataorder" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function(){
            $('#dataorder').DataTable({
                responsive: false,
                processing: false,
                serverSide: true,
                ajax: '{!! route('table.order') !!}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle text-center', width:30},
                    {data: 'id', name: 'id', class: 'align-middle'},
                    {data: 'fullname', name: 'fullname', class: 'align-middle'},
                    {data: 'order_date', name: 'order_date', class: 'align-middle', width:90},
                    {data: 'status', name: 'status', class: 'align-middle', width:140},
                    {data: 'action', name: 'action', searchable: false, orderable: false, width:115, class: 'align-middle'}
                ]
            });
        });
    </script>
@endpush
@endsection