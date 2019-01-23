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
                        <h1>Category</h1><br>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('newCategory')}}" type="submit" class="btn btn-primary" style="float:right">Add Category</a>
                    </div>
                </form>
            </div>
            <div class="container">
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
                                            <td style="width:30px"><img class="img-fluid" src="{{ URL::to('/upload/'.$category->category_image)}}"></td>
                                            <td>{{$category->category_name}}</td>
                                            <td><a href="{{ route('editCategory', $category->id) }}" class="btn btn-warning" name="edit">Edit</a>
                                                <a href="{{ route('deleteCategory', $category->id) }}" class="btn btn-danger" name="delete">Delete</a>
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
        </div>
    
@endsection