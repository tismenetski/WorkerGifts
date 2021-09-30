@extends('admin.layouts.app')
@section('content')

<div class="container">
    @if($errors)
        <div class="alert-danger">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form id="addGift" method="POST" action="{{route('updateGift')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Gift Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$gift->name}}">
            </div>
            <div class="form-group">
                <label for="description" class="mt-2">Description</label>
                <textarea form="addGift" class="form-control" id="description" name="description">{{$gift->description ?? ""}}</textarea>
            </div>
            <div class="form-group">
                <label for="value" class="mt-2">Value</label>
                <input type="number" min="0" class="form-control" id="value" name="value" value="{{$gift->value}}">
            </div>
            <div class="form-group">
                <img src="{{$gift->image?? ""}}" alt="Gift Image">
                <label for="image" class="mt-2">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="gift_category" class="mt-2">Category</label>
                <select class="form-control" id="gift_category" >
                    @foreach($gift_categories as $gift_category)
                        @if($gift_category === $gift->category->name)
                        <option value="{{$gift_category->id}}" selected>{{$gift_category->name}}</option>
                        @else
                            <option value="{{$gift_category->id}}">{{$gift_category->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <input type="hidden" id="id" name="id" value="{{$gift->id}}">
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>

</div>
@endsection
