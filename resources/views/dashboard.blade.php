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
                        <input type="hidden" name="email" id="email">
                    </form>
                    <table style="width: 100%">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="text-align: center;"><button class="form-control" onclick="viewUser('{{ $user->email }}')">View</button></td>
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
        var email = document.getElementById("email");
        email.value = val;

        var form = document.getElementById("fetchUserForm");
        form.submit();
    }
</script>
@endsection