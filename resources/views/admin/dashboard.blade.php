@extends('admin.layouts.app')
@section('content')
    <h1 class="mt-4 p-4">Hello {{config('app.app_admin')}}</h1>
{{--    {{dump($workers)}}--}}
    @if(empty($workers))
        <div class="container">
            <p>No Data Found, Please upload an excel file</p>
        </div>
    @else
        <div class="container">
            <h1 class="text-center">List of Issued Gift Cards</h1>
            <table class="table-bordered">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Start Working Date</th>
                        <th>Gift Card Value</th>
                        <th>Gift Card Used</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($workers as $worker)
                    <tr class="text-center">
                        <td>{{$worker->id}}</td>
                        <td>{{$worker->first_name}}</td>
                        <td>{{$worker->last_name}}</td>
                        <td>{{$worker->email}}</td>
                        <td>{{$worker->department}}</td>
                        <td>{{$worker->position}}</td>
                        <td>{{$worker->work_start_date}}</td>
                        <td>{{$worker->giftcard->amount}}</td>
                        <td>NO</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
@endsection
