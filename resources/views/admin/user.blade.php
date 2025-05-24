@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong>{{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('error_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Error:</strong>{{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User</h3>
                                <a style="max-width: 150px; float: right; display:inline-block;" data-bs-toggle="modal"
                                    data-bs-target="#addUser"
                                    class="btn btn-block btn-primary">Tambah</a>
                            </div>

                            <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Edit User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form id="subadminForm" action="{{ url('admin/add-user') }}" method="post"
                                                enctype="multipart/form-data">@csrf
                                                <div class="card-body">
                                                    <div class="form-group col-md-12">
                                                        <label for="email">Email*</label>
                                                        <input type="email" required
                                                            class="form-control" id="email" name="email"
                                                            placeholder="Masukkan Email">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="password">Kata Sandi*</label>
                                                        <input type="password" class="form-control" id="password" required
                                                            name="password" placeholder="Masukkan Kata Sandi">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="name">Nama*</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" placeholder="Masukkan Nama">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="telepon">Nomer HP*</label>
                                                        <input type="text" class="form-control" id="telepon"
                                                            name="telepon" placeholder="Masukkan Nomer HP">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="alamat">Alamat*</label>
                                                        <input type="text" class="form-control" id="alamat"
                                                            name="alamat" placeholder="Masukkan Nomer HP">
                                                    </div>

                                                </div>
                                                <!-- /.card-body -->
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="subadmins" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>No. HP</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->telepon }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->alamat }}</td>

                                                <td>{{ date('F j, Y, g:i a', strtotime($user->created_at)) }}</td>
                                                <td>

                                                    &nbsp; &nbsp;
                                                    <a href="{{ url('admin/add-edit-user', $user->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#myModal{{ $loop->iteration }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    &nbsp; &nbsp;
                                                    <a class="confirmDelete" name="user" title="Delete user"
                                                        href="{{ route('delete.user', $user->id) }}" record="user"
                                                        recordid="{{ $user->id }}"><i class="fas fa-trash"></i></a>
                                                    &nbsp; &nbsp;
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="myModal{{ $loop->iteration }}" tabindex="-1"
                                                aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Edit User</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form id="subadminForm"
                                                                action="{{ url('admin/update-user', $user->id) }}"
                                                                method="post" enctype="multipart/form-data">@csrf
                                                                <div class="card-body">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="email">Email*</label>
                                                                        <input disabled="" value="{{ $user->email }}"
                                                                            style="background-color: #666666"
                                                                            type="email" class="form-control"
                                                                            id="email" name="email"
                                                                            placeholder="Masukkan Email">
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="password">Kata Sandi</label>
                                                                        <p>*Jika ingin mengganti sandi masukkan sandi baru,
                                                                            jika tidak cukup di kosongi</p>
                                                                        <input type="password" class="form-control"
                                                                            id="password" name="password"
                                                                            placeholder="Masukkan Kata Sandi">
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="name">Nama*</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $user->name }}" id="name"
                                                                            name="name" placeholder="Masukkan Nama">
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="telepon">Nomer HP*</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $user->telepon }}" id="telepon"
                                                                            name="telepon"
                                                                            placeholder="Masukkan Nomer HP">
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="alamat">Alamat*</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $user->alamat }}" id="alamat"
                                                                            name="alamat"
                                                                            placeholder="Masukkan Nomer HP">
                                                                    </div>

                                                                </div>
                                                                <!-- /.card-body -->
                                                                <div class="form-group col-md-12">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Kirim</button>
                                                                </div>

                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
