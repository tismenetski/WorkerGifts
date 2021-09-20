@extends('admin.layouts.app')

@section('scripts')

@endsection

@section('content')
    <h1 class="mt-4 p-4">Hello {{config('app.app_admin')}}</h1>

    <form action="{{route('postExcel')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                        @foreach($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if (Session::has('success'))
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5>{!! Session::get('success') !!}</h5>
                    </div>
                </div>
            </div>
        @endif

        <input type="file" name="file" class="form-control">
        <button class="btn btn-success mx-4 my-4">Import Data</button>
    </form>

@endsection
