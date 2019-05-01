@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                <h1><span class="fas fa-dolly-flatbed" aria-hidden="true"></span> Order</h1><br>
                    <div class="table-responsive"  style="margin-top:20px">
                        <table id="dataorder" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order ID</th>
                                    <th>Fullname</th>
                                    <th>Total</th>
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
                    {data: 'total', name: 'total', class: 'align-middle'},
                    {data: 'order_date', name: 'order_date', class: 'align-middle', width:90},
                    {data: 'status', name: 'status', class: 'align-middle', width:140},
                    {data: 'action', name: 'action', searchable: false, orderable: false, width:115, class: 'align-middle'}
                ]
            });
        });
    </script>
@endpush
@endsection