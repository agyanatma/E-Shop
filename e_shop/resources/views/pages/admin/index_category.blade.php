@extends('layout.admin')

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
                    <h1><span class="fas fa-clipboard-list" aria-hidden="true"></span>  Category</h1><br>
                </div>
                <div class="col-lg-6">
                    <a href="{{ route('newCategory')}}" type="submit" class="btn btn-primary" style="float:right">Add Category</a>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Category</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                        @if(count($categories) > 0)
                            @foreach ($categories as $category)
                            <tr>
                                <td class="align-middle" style="width:80px"><img class="img" style="object-fit:cover" width="50px" height="50px" src="{{$category->category_image}}"></td>
                                <td class="align-middle">{{$category->category_name}}</td>
                                <td class="align-middle" style="width:160px">
                                    <span class="float-right">
                                        <a href="{{ route('editCategory', $category->id) }}" class="btn btn-warning" name="edit">Edit</a>
                                        <a href="{{ route('deleteCategory', $category->id) }}" class="btn btn-danger" name="delete">Delete</a>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <h3>No posts found!</h3>
                        @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection