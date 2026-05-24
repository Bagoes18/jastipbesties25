@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Request Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Request Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong>{{ Session::get('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong>{{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Request Produk</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-striped bg-transparent">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Referensi</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Gambar</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Respon Admin</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($request as $req)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><code>{{ $req->reference ?? '-' }}</code></td>
                                                <td>
                                                    {{ $req->user->name ?? 'User tidak dikenal' }}<br>
                                                    <small>{{ $req->user->email ?? '' }}</small>
                                                </td>
                                                <td>{{ $req->name }}</td>
                                            <td>
                                                @if ($req->image)
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#image{{ $req->id }}">Lihat</button>
                                                @else
                                                <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($req->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                                @elseif ($req->status == 'approved')
                                                <span class="badge badge-success">Disetujui</span>
                                                @elseif ($req->status == 'rejected')
                                                <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $req->admin_response ?? '-' }}</td>
                                            <td>
                                                @if ($req->status == 'pending')
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#respondModal{{ $req->id }}">
                                                    Respon
                                                </button>
                                                @else
                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#respondModal{{ $req->id }}">
                                                    Ubah
                                                </button>
                                                @endif
                                            </td>
                                        </tr>

                                        {{-- Modal Gambar --}}
                                        <div class="modal fade" id="image{{ $req->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Gambar Request</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if ($req->image)
                                                        <img src="{{ asset('front/images/' . $req->image) }}"
                                                            alt="Gambar Request" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal Respon --}}
                                        <div class="modal fade" id="respondModal{{ $req->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ url('admin/request/respond/' . $req->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Respon Request: {{ $req->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select name="status" class="form-control" required>
                                                                    <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                    <option value="approved" {{ $req->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                                                    <option value="rejected" {{ $req->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Pesan Respon</label>
                                                                <textarea name="admin_response" class="form-control" rows="4" placeholder="Masukkan pesan untuk user...">{{ $req->admin_response }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>User:</strong> {{ $req->user->name ?? '-' }} ({{ $req->user->email ?? '-' }})
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Kirim Respon</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection