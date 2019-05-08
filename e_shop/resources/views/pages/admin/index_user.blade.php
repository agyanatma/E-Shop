@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <h1><span class="fas fa-users"></span> Users</h1><br>
                    <div class="table-responsive" style="margin-top:20px">
                        <table id="datauser" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th><a href="{{ route('add.user') }}" type="submit" class="btn btn-sm btn-info align-middle" style="width:110px">Add User</a></th>
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
            $('#datauser').DataTable({
            responsive: false,
            processing: false,
            serverSide: true,
            ajax: '{!! route('table.user') !!}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', width:30, searchable: false},
                {data: 'email', name: 'email'},
                {data: 'fullname', name: 'fullname'},
                {data: 'role', name: 'role', width:30, searchable: false},
                {data: 'action', name: 'action', searchable: false, orderable: false, width:115}
            ]
        });
        });
    </script>
@endpush
@endsection