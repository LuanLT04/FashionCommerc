
@extends('admin.dashboard')
@section('content')

<h1>Search Results</h1>
<table class="table table-hover">
<thead>
        <tr>
             <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
    </thead>
    <thead>
        <tr>
        @foreach($users as $item)
             <th>{{ $item->id_user }}</th>
            <th>{{ $item->name }}</th>
            <th>{{ $item->email }}</th>
            <th>{{ $item->phone }}</th>
            <th>{{ $item->address }}</th>
        </tr>
        @endforeach
    </thead>
    <tbody>
    </tbody>
</table>
@endsection('content')