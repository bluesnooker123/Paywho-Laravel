@extends('layout')
  
@section('content')
<style>
    table, th, td {
      border: 1px solid black;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Information</div>
  
                <div class="card-body">
                    <table style="width: 100%">
                        <thead>
                            <tr class="bg-success" style="text-align: center;">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Birthday</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->birthday }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection