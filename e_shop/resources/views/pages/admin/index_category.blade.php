@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <h1><span class="fas fa-clipboard-list" aria-hidden="true"></span> Categories</h1><br>
                    <div class="table" style="margin-top:20px">
                        <table id="datacategory" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th><a href="{{ route('create.category')}}" type="submit" class="btn btn-info" style="width:110">Add Category</a></th>
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
            $('#datacategory').DataTable({
                responsive: false,
                processing: false,
                serverSide: true,
                ajax: '{!! route('table.category') !!}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle text-center', width:30},
                    {data: 'category_name', name: 'category_name', class: 'align-middle'},
                    {data: 'category_image', name: 'category_image', class: 'align-middle', width:60, searchable: false, orderable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false, width:115, class: 'align-middle text-center'}
                ]
            });
        });
    </script>
    @endpush
@endsection