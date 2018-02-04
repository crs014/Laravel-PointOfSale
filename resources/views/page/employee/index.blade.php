@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Karyawan</h1>
    </section>
    <!-- Main content -->
    <section class="content"><!-- /.row -->
        <div class="box box-primary">
            <div class="box-header">
                <small>
                    * Jika password user direset maka password jadi grandeur123
                </small>
            </div>
            <div class="box-body">
                <form id="form-change-password" role="form" method="POST" action="{{ route('employee.store') }}" novalidate class="form-horizontal">
                    <div class="col-md-9">
                        <label for="name" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                        </div>
                        <label for="username" class="col-sm-4 control-label">User Login</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="user-login" name="email" placeholder="User Login">
                            </div>
                        </div>             
                        <label for="password" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <label for="re-password" class="col-sm-4 control-label">Re Password</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Re Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-6">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <table class="table table-bordered table-responsive table-striped" id="table-product" width="100%">
                    <thead>
                        <tr>
                            <th>User Login</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody> 
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->email}}</td>
                        <td>{{$user->name}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-2">
                                    <form action="/employee/{{$user->id}}/delete" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="delete" />
                                        <button class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form action="/employee/{{$user->id}}/reset" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class='btn btn-info'><i class='fa fa-info'></i> Reset</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>                    
                </table>
                {{ $users->links() }}
            </div> 
        </div>    
    </section>
@endsection