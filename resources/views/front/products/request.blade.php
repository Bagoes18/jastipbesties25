@extends('front.layout.layout')
@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong>{{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="breadcrumb__text">
                    <h4>{{ isset($req) ? 'Detail Request' : (auth()->check() ? 'Request' : 'Cek Status Request') }}</h4>
                    <div class="breadcrumb__links">
                        <a href="/">Beranda</a>
                        <span> / {{ isset($req) ? 'Detail Request' : (auth()->check() ? 'Request' : 'Cek Status Request') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tampilkan hasil pengecekan status jika ada --}}
        @if (isset($req))
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Detail Request</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <tr>
                                <th width="35%">Nomor Referensi</th>
                                <td><strong>{{ $req->reference }}</strong></td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td>{{ $req->name }}</td>
                            </tr>
                            <tr>
                                <th>Gambar</th>
                                <td>
                                    @if ($req->image)
                                    <a href="{{ asset('front/images/' . $req->image) }}" target="_blank">Lihat Gambar</a>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($req->status == 'pending')
                                    <span class="badge bg-warning text-dark" style="font-size:14px;">Pending</span>
                                    @elseif ($req->status == 'approved')
                                    <span class="badge bg-success" style="font-size:14px;">Disetujui</span>
                                    @elseif ($req->status == 'rejected')
                                    <span class="badge bg-danger" style="font-size:14px;">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Respon Admin</th>
                                <td>{{ $req->admin_response ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Request</th>
                                <td>{{ $req->created_at->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cek status lain --}}
        <div class="row justify-content-center mt-4 mb-5">
            <div class="col-lg-6 col-md-8">
                <div class="text-center">
                    <a href="{{ url('/request') }}" class="btn btn-outline-primary">Cek Status Lain</a>
                </div>
            </div>
        </div>

        @elseif (!auth()->check())
        {{-- Guest: Form Cek Status Request --}}
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-lg-6 col-md-8">
                <form action="{{ url('/request') }}" method="POST" class="p-4 border rounded bg-light">
                    @csrf
                    <h4 class="mb-4 text-center">Cek Status Request Produk</h4>
                    <p class="text-muted text-center mb-4">Masukkan nomor referensi request Anda untuk mengecek status terkini.</p>
                    <div class="mb-3">
                        <label for="reference" class="form-label">Nomor Referensi</label>
                        <input type="text" name="reference" class="form-control form-control-lg" id="reference"
                            placeholder="Contoh: R20260425235708FCXNZ" value="{{ old('reference') }}" required>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-lg px-5" type="submit">Cek Status</button>
                    </div>
                </form>
            </div>
        </div>

        @else
        {{-- Auth: Form Request Produk --}}
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
                                    <th>Referensi</th>
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
                                    <td><code>{{ $ur->reference }}</code></td>
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
