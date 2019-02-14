@extends('layout.admin')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
            <h1><span class="fas fa-box-open" aria-hidden="true"></span>  Product</h1>
            <div class="table-responsive" style="margin-top:20px">
                <table id="dataproduct" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th><a href="{{ route('product.new')}}" type="submit" class="btn btn-primary align-middle float-right" style="width:145px">Add Product</a></th>
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
                processing: false,
                serverSide: true,
                ajax: '{!! route('table.product') !!}',
                columns: [
                    {data: 'images', name: 'images', class: 'align-middle', width:60, searchable: false, orderable: false},
                    {data: 'product_name', name: 'product', class: 'align-middle'},
                    {data: 'category_name', name: 'category', class: 'align-middle'},
                    {data: 'product_price', name: 'price', class: 'align-middle'},
                    {data: 'action', name: 'action', searchable: false, orderable: false, width:145, class: 'align-middle'}
                ]
            });
        });
    </script>
    @endpush
@endsection