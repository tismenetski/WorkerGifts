@extends('admin.layouts.app')
@section('content')
    <div class="container mx-auto">
    <h1 class="text-center mt-4">Gifts</h1>
        <a class="btn-success mt-4 mx-auto btn-lg d-inline-block text-decoration-none pointer-event" href="{{route('addGift')}}">Add Gifts</a>
        {{dump($gifts)}}
        @if(empty($gifts) || sizeof($gifts) == 0)
            <h1>No Gifts available, please add gifts</h1>
        @else
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr class="text-center">
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Value</th>
                <th>Image</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($gifts as $gift)
                <tr class="text-center">
                    <td>
                        {{$gift->id}}
                    </td>
                    <td>
                        {{$gift->name}}
                    </td>
                    <td>
                        {{$gift->description ?? ""}}
                    </td>
                    <td>
                        {{$gift->value}}
                    </td>
                    <td>
                        {{$gift->image ??  ""}}
                    </td>
                    <td>
                        {{$gift->category->name ?? ""}}
                    </td>
                    <td>
                        <a href="{{route('editGift',['id' => $gift->id])}}" class="btn btn-primary pointer-event">Edit</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger pointer-event">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection
