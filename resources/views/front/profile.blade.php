@extends('front.layout.layout')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Profile</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Beranda</a>
                            <span> / Profile</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex w-100 justify-content-center mt-5 mb-5" >
                <div class="card p-4 shadow-sm bg-grey" style="background-color: #f0f0f0">
                    <!-- Total Harga -->
                    <div class="mb-3">
                        <strong>Name</strong>
                        <div class="form-control bg-light">
                            {{ $user->name }}
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="mb-3">
                        <strong>Email</strong>
                        <div class="form-control bg-light">
                            {{ $user->email }}
                        </div>
                    </div>

                    <!-- Nomor Rekening -->
                    <div class="mb-3">
                        <strong>Telepon</strong>
                        <div class="form-control bg-light">
                            {{ $user->telepon }}
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="mb-3">
                        <strong>Alamat</strong>
                        <div class="form-control bg-light">
                            {{ $user->alamat }}
                    </div>
                    <div class="mb-3 mt-5">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Edit</button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #dad8d8">

                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body" >
                            <form id="user"
                                action="{{ route('profile.update') }}"
                                method="post" enctype="multipart/form-data">@csrf
                                <div class="card-body" >
                                    <div class="form-group col-md-12">
                                        <label for="email">Email*</label>
                                        <input disabled="" value="{{ $user->email }}"
                                            style="background-color: #bebebe"
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
        </div>
    </div>
@endsection
