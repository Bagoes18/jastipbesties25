@extends('front.layout.layout')
@section('content')
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
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-lg-8 col-md-10">
                <form action="{{ url('/request') }}" method="POST" enctype="multipart/form-data"
                    class="p-4 border rounded bg-light">
                    @csrf
                    <h4 class="mb-4 text-center">Request Product</h4>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                        <input type="text" name="name" class="form-control form-control-lg" id="exampleFormControlInput1"
                            placeholder="Nama Barang">
                    </div>
                    <div class="mb-3">
                        <label for="inputGroupFile02" class="form-label">Gambar (opsional)</label>
                        <input type="file" name="image" class="form-control form-control-lg" id="inputGroupFile02" accept="image/*">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-lg px-5" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Riwayat Request User --}}
        @if (auth()->check())
        @php
            $userRequests = auth()->user()->requestProducts()->latest()->get();
        @endphp
        @if ($userRequests->count() > 0)
        <div class="row mt-4">
            <div class="col-lg-12">
                <h4>Riwayat Request Saya</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th>Respon Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userRequests as $ur)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ur->name }}</td>
                                <td>
                                    @if ($ur->image)
                                    <a href="{{ asset('front/images/' . $ur->image) }}" target="_blank">Lihat</a>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if ($ur->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif ($ur->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                    @elseif ($ur->status == 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $ur->admin_response ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        @endif
    </div>
</div>
@endsection