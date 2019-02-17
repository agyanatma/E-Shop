@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin:0px 100px">
            <h1><span class="fas fa-box-open" aria-hidden="true"></span>  Product</h1>
            <div class="table-responsive" style="margin-top:20px">
                <table id="dataproduct" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th><a href="{{ route('create.product') }}" type="submit" class="btn btn-sm btn-primary align-middle" style="width:115px">Add Product</a></th>
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
            $('#dataproduct').DataTable({
                responsive: true,
                processing: false,
                serverSide: true,
                ajax: '{!! route('table.product') !!}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle text-center', width:30},
                    {data: 'product_name', name: 'product_name', class: 'align-middle'},
                    {data: 'category_name', name: 'category_name', class: 'align-middle'},
                    {data: 'product_price', name: 'product_price', class: 'align-middle'},
                    {data: 'images', name: 'images', class: 'align-middle', width:60, orderable: false, searchable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false, class: 'align-middle', width:115}
                ]
            });
        });
    </script>
@endpush
@endsection