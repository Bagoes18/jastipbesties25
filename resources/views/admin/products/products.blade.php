@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Produk</h3>
                            @if ($productsModul['edit_access']==1 || $productsModul['full_access']==1)
                            <a style="max-width: 150px; float: right; display:inline-block;"
                                href="{{ url('admin/add-edit-product') }}" class="btn btn-block btn-primary">Tambah</a>
                            @endif


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="products" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Kode Produk</th>
                                        <th>Warna Produk</th>
                                        <th>Kategori</th>
                                        <th>Kategori Induk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product['id'] }}</td>
                                        <td>{{ $product['product_name'] }}</td>
                                        <td>{{ $product['product_code'] }}</td>
                                        <td>{{ $product['product_color'] }}</td>
                                        <td>{{ $product['category']['category_name'] }}</td>
                                        <td>
                                            @if (isset($product['category']['parentcategory']['category_name']))
                                            {{ $product['category']['parentcategory']['category_name'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($productsModul['edit_access']==1 || $productsModul['full_access']==1)
                                            @if ($product['status']==1)
                                            <a class="updateProductStatus" id="product-{{ $product['id'] }}"
                                                product_id="{{ $product['id'] }}" href="javascript:void(0)"><i
                                                    class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                            <a class="updateProductStatus" id="product-{{ $product['id'] }}"
                                                product_id="{{ $product['id'] }}" style="color:grey"
                                                href="javascript:void(0)"><i class="fas fa-toggle-off"
                                                    status="Inactive"></i></a>
                                            @endif
                                            @endif
                                            &nbsp; &nbsp;
                                            @if ($productsModul['edit_access']==1 || $productsModul['full_access']==1)
                                            <a href="{{ url('admin/add-edit-product',$product['id']) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            &nbsp; &nbsp;
                                            @endif
                                            @if ($productsModul['full_access']==1)
                                            <a class="confirmDelete" title="Delete product" href="javascript:void(0)"
                                                record="product" recordid="{{ $product['id'] }}"><i
                                                    class="fas fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
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