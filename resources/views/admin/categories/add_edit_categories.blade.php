@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
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
                            <form name="categoryForm" id="categoryForm" @if (empty($category['id']))
                                action="{{ url('admin/add-edit-category') }}" @else
                                action="{{ url('admin/add-edit-category/' . $category['id']) }}" @endif method="post"
                                enctype="multipart/form-data">@csrf
                                <div class="card-body">
                                    <div class="form-group col-md-6">
                                        <label for="category_name">Nama Kategori*</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name"
                                            placeholder="Masukkan Nama Kategori" @if(!empty($category['category_name']))
                                            value="{{ $category['category_name'] }}"> @else value="{{
                                        old('category_name') }}"> @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="category_name">Tingkat Kategori*</label>
                                        <select name="parent_id" class="form-control">
                                            <option value="">Pilihan</option>
                                            <option value="0" @if ($category['parent_id']==0) selected="" @endif>Induk
                                                Kategori</option>
                                            @foreach ($getCategories as $cat)
                                            <option
                                                @if(isset($category['parent_id'])&&$category['parent_id']==$cat['id'])
                                                selected="" @endif value="{{ $cat['id'] }}">{{ $cat['category_name'] }}
                                            </option>
                                            @if (!empty($cat['subcategories']))
                                            @foreach ($cat['subcategories'] as $subcat)
                                            <option value="{{ $subcat['id'] }}"
                                                @if(isset($category['parent_id'])&&$category['parent_id']==$subcat['id'])
                                                selected="" @endif>&nbsp;&nbsp;&raquo;{{
                                                $subcat['category_name']
                                                }}</option>
                                            @if (!empty($subcat['subcategories']))
                                            @foreach ($subcat['subcategories'] as $subsubcat)
                                            <option value="{{ $subsubcat['id'] }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;{{
                                                $subsubcat['category_name']
                                                }}</option>


                                            @endforeach
                                            @endif


                                            @endforeach
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="category_image">Gambar Kategori</label>
                                        <input type="file" class="form-control" id="category_image"
                                            name="category_image">
                                        @if (!empty($category['category_image']))
                                        <a target="_blank"
                                            href="{{ url('front/images/categories/'.$category['category_image']) }}"><img
                                                style="width: 50px; margin: 10px;"
                                                src="{{ asset('front/images/categories/'.$category['category_image']) }}"></a>
                                        <a class="confirmDelete" title="Delete Category Image" href="javascript:void(0)"
                                            record="category-image" recordid="{{ $category['id'] }}" <?php /*
                                            href="{{ url('delete-category/',$category['id']) }}" */ ?> ><i
                                                class="fas fa-trash"></i></a>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="category_discount">Diskon Kategori</label>
                                        <input type="text" class="form-control" id="category_discount"
                                            name="category_discount" placeholder="Enter Category Discount"
                                            @if(!empty($category['category_discount']))
                                            value="{{ $category['category_discount'] }}">
                                        @else value="{{ old('category_discount') }}"> @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="url">URL Kategori*</label>
                                        <input type="text" class="form-control" id="url" name="url"
                                            placeholder="Enter Category URL" @if (!empty($category['url']))
                                            value="{{ $category['url'] }}">
                                        @else value="{{ old('url') }}"> @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="description">Deskripsi Kategori</label>
                                        <textarea class="form-control" rows="3" id="description" name="description"
                                            placeholder="Enter Category Description">@if (!empty($category['description']))
                                            {{ $category['description'] }}
                                            @endif{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title">Tag Judul</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            placeholder="Enter Meta Title" @if (!empty($category['meta_title']))
                                            value="{{ $category['meta_title'] }}">
                                        @else value="{{ old('meta_title') }}"> @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_description">Tag Deskripsi</label>
                                        <input type="text" class="form-control" id="meta_description"
                                            name="meta_description" placeholder="Enter Meta Description"
                                            @if(!empty($category['meta_title'])) value="{{ $category['meta_title'] }}">
                                        @else value="{{ old('meta_title') }}"> @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_keywords">Tag Kata Kunci</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                            placeholder="Enter Meta Keywords" @if (!empty($category['meta_keywords']))
                                            value="{{ $category['meta_keywords'] }}">
                                        @else value="{{ old('meta_keywords') }}"> @endif
                                    </div>


                                </div>
                                <!-- /.card-body -->
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
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