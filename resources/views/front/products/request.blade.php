@extends('front.layout.layout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong>{{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="breadcrumb__text">
                    <h4>Request</h4>
                    <div class="breadcrumb__links">
                        <a href="/">Beranda</a>
                        <span> / Request</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex w-100 justify-content-center mt-5 mb-5">
            <form action="{{ url('/request') }}" method="POST" enctype="multipart/form-data"
                class="d-flex flex-column align-items-center gap-2 bg-light">
                @csrf
                <h4 class="mt-5">Request Product</h4>
                <div class="mb-3 w-50">
                    <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                        placeholder="Nama Barang">
                </div>
                <div class="input-group mb-3 w-50">
                    <input type="file" name="image" class="form-control" id="inputGroupFile02" accept="image/*">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
                <button class="btn btn-primary mb-5" type="submit">Kirim</button>
            </form>
        </div>
    </div>
</div>
@endsection