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
                <div class="card-header">Users</div>
  
                <div class="card-body">
                    <form method="POST" action="{{ url('fetch_user') }}" id="fetchUserForm">
                        @csrf
                        <input type="hidden" name="id" id="id">
                    </form>
                    <table style="width: 100%">
                        <thead>
                            <tr class="bg-info" style="text-align: center;">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Birthday</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->birthday }}</td>
                                    <td class="p-1" style="text-align: center;"><button class="form-control btn btn-primary w-75" onclick="viewUser('{{ $user->id }}')">View</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function viewUser(val) {
        var id = document.getElementById("id");
        id.value = val;

        var form = document.getElementById("fetchUserForm");
        form.submit();
    }
</script>
@endsection