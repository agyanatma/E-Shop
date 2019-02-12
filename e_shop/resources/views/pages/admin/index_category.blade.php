@extends('layout.admin')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <h1><span class="fas fa-clipboard-list" aria-hidden="true"></span> Category</h1><br>
        <div class="table-responsive" style="margin-top:20px">
            <table id="datacategory" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Image</th>
                        <th><a href="{{ route('newCategory')}}" type="submit" class="btn btn-primary" style="float:initial">Add Category</a></th>
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
            $('#datacategory').DataTable({
                processing: false,
                serverSide: true,
                ajax: '{!! route('table.category') !!}',
                columns: [
                    {data: 'category_name', name: 'category_name', class: 'align-middle'},
                    {data: 'category_image', name: 'category_image', class: 'align-middle', width:60, searchable: false, orderable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false, width:120, class: 'align-middle'}
                ]
            });
        });
    </script>
    @endpush
@endsection