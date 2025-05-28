@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error:</strong>{{ Session::get('error_message') }}
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
                            <form name="subadminForm" id="subadminForm" action="{{ url('admin/update-role/' . $id) }}"
                                method="post">@csrf
                                <input type="hidden" name="subadmin_id" value="{{ $id }}">
                                @if (!empty($subadminRoles))
                                @foreach ($subadminRoles as $role)
                                @if ($role['module']=="cms_pages")
                                @if ($role['view_access']==1)
                                @php
                                $viewCMSPages = "checked"
                                @endphp
                                @else
                                @php
                                $viewCMSPages = ""
                                @endphp
                                @endif
                                @if ($role['edit_access']==1)
                                @php
                                $editCMSPages = "checked"
                                @endphp
                                @else
                                @php
                                $editCMSPages = ""
                                @endphp
                                @endif
                                @if ($role['full_access']==1)
                                @php
                                $fullCMSPages = "checked"
                                @endphp
                                @else
                                @php
                                $fullCMSPages = ""
                                @endphp
                                @endif
                                @endif
                                @if ($role['module']=="categories")
                                @if ($role['view_access']==1)
                                @php
                                $viewCategories = "checked"
                                @endphp
                                @else
                                @php
                                $viewCategories = ""
                                @endphp
                                @endif
                                @if ($role['edit_access']==1)
                                @php
                                $editCategories = "checked"
                                @endphp
                                @else
                                @php
                                $editCategories = ""
                                @endphp
                                @endif
                                @if ($role['full_access']==1)
                                @php
                                $fullCategories = "checked"
                                @endphp
                                @else
                                @php
                                $fullCategories = ""
                                @endphp
                                @endif
                                @endif
                                @if ($role['module']=="products")
                                @if ($role['view_access']==1)
                                @php
                                $viewProducts = "checked"
                                @endphp
                                @else
                                @php
                                $viewProducts = ""
                                @endphp
                                @endif
                                @if ($role['edit_access']==1)
                                @php
                                $editProducts = "checked"
                                @endphp
                                @else
                                @php
                                $editProducts = ""
                                @endphp
                                @endif
                                @if ($role['full_access']==1)
                                @php
                                $fullProducts = "checked"
                                @endphp
                                @else
                                @php
                                $fullProducts = ""
                                @endphp
                                @endif
                                @endif
                                @if ($role['module']=="brands")
                                @if ($role['view_access']==1)
                                @php
                                $viewBrands = "checked"
                                @endphp
                                @else
                                @php
                                $viewBrands = ""
                                @endphp
                                @endif
                                @if ($role['edit_access']==1)
                                @php
                                $editBrands = "checked"
                                @endphp
                                @else
                                @php
                                $editBrands = ""
                                @endphp
                                @endif
                                @if ($role['full_access']==1)
                                @php
                                $fullBrands = "checked"
                                @endphp
                                @else
                                @php
                                $fullBrands = ""
                                @endphp
                                @endif
                                @endif
                                @if ($role['module']=="banners")
                                @if ($role['view_access']==1)
                                @php
                                $viewBanners = "checked"
                                @endphp
                                @else
                                @php
                                $viewBanners = ""
                                @endphp
                                @endif
                                @if ($role['edit_access']==1)
                                @php
                                $editBanners = "checked"
                                @endphp
                                @else
                                @php
                                $editBanners = ""
                                @endphp
                                @endif
                                @if ($role['full_access']==1)
                                @php
                                $fullBanners = "checked"
                                @endphp
                                @else
                                @php
                                $fullBanners = ""
                                @endphp
                                @endif
                                @endif
                                @if ($role['module']=="pesanan")
                                @if ($role['view_access']==1)
                                @php
                                $viewPesanan = "checked"
                                @endphp
                                @else
                                @php
                                $viewPesanan = ""
                                @endphp
                                @endif
                                @if ($role['edit_access']==1)
                                @php
                                $editPesanan = "checked"
                                @endphp
                                @else
                                @php
                                $editPesanan = ""
                                @endphp
                                @endif
                                @if ($role['full_access']==1)
                                @php
                                $fullPesanan = "checked"
                                @endphp
                                @else
                                @php
                                $fullPesanan = ""
                                @endphp
                                @endif
                                @endif
                                @if ($role['module']=="request")
                                @if ($role['view_access']==1)
                                @php
                                $viewRequest = "checked"
                                @endphp
                                @else
                                @php
                                $viewRequest = ""
                                @endphp
                                @endif
                                @if ($role['edit_access']==1)
                                @php
                                $editRequest = "checked"
                                @endphp
                                @else
                                @php
                                $editRequest = ""
                                @endphp
                                @endif
                                @if ($role['full_access']==1)
                                @php
                                $fullRequest = "checked"
                                @endphp
                                @else
                                @php
                                $fullRequest = ""
                                @endphp
                                @endif
                                @endif
                                @if ($role['module']=="laporan")
                                @if ($role['view_access']==1)
                                @php
                                $viewLaporan = "checked"
                                @endphp
                                @else
                                @php
                                $viewLaporan = ""
                                @endphp
                                @endif
                                @if ($role['edit_access']==1)
                                @php
                                $editLaporan = "checked"
                                @endphp
                                @else
                                @php
                                $editLaporan = ""
                                @endphp
                                @endif
                                @if ($role['full_access']==1)
                                @php
                                $fullLaporan = "checked"
                                @endphp
                                @else
                                @php
                                $fullLaporan = ""
                                @endphp
                                @endif
                                @endif
                                @endforeach
                                @endif
                                <div class="card-body">
                                    {{-- <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input disabled="" style="background-color: #666666" type="email"
                                            class="form-control" id="email" name="email" placeholder="Enter Email">
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label for="cms_pages">CMS Pages:</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="checkbox" value="1" name="cms_pages[view]"
                                            @if(isset($viewCMSPages)) {{ $viewCMSPages }} @endif>&nbsp;View Access
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="checkbox" value="1" name="cms_pages[edit]"
                                            @if(isset($editCMSPages)) {{ $editCMSPages }} @endif>&nbsp;Edit Access
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="checkbox" value="1" name="cms_pages[full]"
                                            @if(isset($fullCMSPages)) {{ $fullCMSPages }} @endif>&nbsp;Full Access
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                    </div>
                                    <div class="form-group">
                                        <label for="categories">Categories:</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="checkbox" value="1" name="categories[view]"
                                            @if(isset($viewCategories)) {{ $viewCategories }} @endif>&nbsp;View Access
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="checkbox" value="1" name="categories[edit]"
                                            @if(isset($editCategories)) {{ $editCategories }} @endif>&nbsp;Edit Access
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="checkbox" value="1" name="categories[full]"
                                            @if(isset($fullCategories)) {{ $fullCategories }} @endif>&nbsp;Full Access
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                    </div>
                                    <div class="form-group">
                                        <label for="products">Products:</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="checkbox" value="1" name="products[view]" @if(isset($viewProducts))
                                            {{ $viewProducts }} @endif>&nbsp;View Access
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="checkbox" value="1" name="products[edit]" @if(isset($editProducts))
                                            {{ $editProducts }} @endif>&nbsp;Edit Access
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="checkbox" value="1" name="products[full]" @if(isset($fullProducts))
                                            {{ $fullProducts }} @endif>&nbsp;Full Access
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                    </div> --}}
                                    <table class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>Modul</th>
                                                <th>Akses Lihat</th>
                                                <th>Akses Edit</th>
                                                <th>Akses Penuh</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Halaman CMS</td>
                                                <td><input type="checkbox" value="1" name="cms_pages[view]" {{
                                                        $viewCMSPages ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="cms_pages[edit]" {{
                                                        $editCMSPages ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="cms_pages[full]" {{
                                                        $fullCMSPages ?? '' }}></td>
                                            </tr>
                                            <tr>
                                                <td>Kategori</td>
                                                <td><input type="checkbox" value="1" name="categories[view]" {{
                                                        $viewCategories ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="categories[edit]" {{
                                                        $editCategories ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="categories[full]" {{
                                                        $fullCategories ?? '' }}></td>
                                            </tr>
                                            <tr>
                                                <td>Produk</td>
                                                <td><input type="checkbox" value="1" name="products[view]" {{
                                                        $viewProducts ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="products[edit]" {{
                                                        $editProducts ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="products[full]" {{
                                                        $fullProducts ?? '' }}></td>
                                            </tr>
                                            <tr>
                                                <td>Merek</td>
                                                <td><input type="checkbox" value="1" name="brands[view]" {{ $viewBrands
                                                        ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="brands[edit]" {{ $editBrands
                                                        ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="brands[full]" {{ $fullBrands
                                                        ?? '' }}></td>
                                            </tr>
                                            <tr>
                                                <td>Banner</td>
                                                <td><input type="checkbox" value="1" name="banners[view]" {{
                                                        $viewBanners ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="banners[edit]" {{
                                                        $editBanners ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="banners[full]" {{
                                                        $fullBanners ?? '' }}></td>
                                            </tr>
                                            <tr>
                                                <td>Pesanan</td>
                                                <td><input type="checkbox" value="1" name="pesanan[view]" {{
                                                        $viewPesanan ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="pesanan[edit]" {{
                                                        $editPesanan ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="pesanan[full]" {{
                                                        $fullPesanan ?? '' }}></td>
                                            </tr>
                                            <tr>
                                                <td>Request</td>
                                                <td><input type="checkbox" value="1" name="request[view]" {{
                                                        $viewRequest ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="request[edit]" {{
                                                        $editRequest ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="request[full]" {{
                                                        $fullRequest ?? '' }}></td>
                                            </tr>
                                            <tr>
                                                <td>Laporan</td>
                                                <td><input type="checkbox" value="1" name="laporan[view]" {{
                                                        $viewLaporan ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="laporan[edit]" {{
                                                        $editLaporan ?? '' }}></td>
                                                <td><input type="checkbox" value="1" name="laporan[full]" {{
                                                        $fullLaporan ?? '' }}></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.card-body -->
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection