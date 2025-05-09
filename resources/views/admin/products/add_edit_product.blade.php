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
                            @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong>{{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
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
                            <form name="productForm" id="productForm" @if (empty($product['id']))
                                action="{{ url('admin/add-edit-product') }}" @else
                                action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif method="post"
                                enctype="multipart/form-data">@csrf
                                <div class="card-body">

                                    <div class="form-group ">
                                        <label for="category_id">Pilih Kategori*</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">Pilihan</option>
                                            @foreach ($getCategories as $cat)
                                            <option @if (!empty(@old('category_id')) && $cat['id']==old('category_id'))
                                                selected="" @elseif (!empty($product['category_id']) &&
                                                $product['category_id']==$cat['id']) selected="" @endif
                                                value="{{ $cat['id'] }}">{{
                                                $cat['category_name'] }}
                                            </option>
                                            @if (!empty($cat['subcategories']))
                                            @foreach ($cat['subcategories'] as $subcat)
                                            <option @if (!empty(@old('category_id')) &&
                                                $subcat['id']==old('category_id')) selected=""
                                                @elseif(!empty($product['category_id']) &&
                                                $product['category_id']==$subcat['id']) selected="" @endif
                                                value="{{ $subcat['id'] }}">&nbsp;&nbsp;&raquo;{{
                                                $subcat['category_name']
                                                }}</option>
                                            @if (!empty($subcat['subcategories']))
                                            @foreach ($subcat['subcategories'] as $subsubcat)
                                            <option @if (!empty(@old('category_id')) &&
                                                $subsubcat['id']==old('category_id')) selected=""
                                                @elseif(!empty($product['category_id']) &&
                                                $product['category_id']==$subsubcat['id']) selected="" @endif
                                                value="{{ $subsubcat['id'] }}">
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
                                    <div class="form-group ">
                                        <label for="brand_id">Pilih Merek*</label>
                                        {{-- <input type="text" class="form-control" id="product_name"
                                            name="product_name" placeholder="Masukkan Nama Produk" @if
                                            (!empty($product['product_name'])) value="{{ $product['product_name'] }}"
                                            @else value="{{ @old('product_name') }}" @endif> --}}
                                        <select name="brand_id" class="form-control" id="brand_id">
                                            <option value="">Pilihan</option>
                                            @foreach ($getBrands as $brand)
                                            <option value="{{ $brand['id'] }}" @if (!empty(@old('brand_id')) &&
                                                $brand['id']==old('brand_id')) selected=""
                                                @elseif(!empty($product['brand_id'])&&$product['brand_id']==$brand['id'])
                                                selected="" @endif>{{ $brand['brand_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="product_name">Nama Produk</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            placeholder="Masukkan Nama Produk" @if (!empty($product['product_name']))
                                            value="{{ $product['product_name'] }}" @else
                                            value="{{ @old('product_name') }}" @endif>
                                    </div>
                                    <div class="form-group ">
                                        <label for="product_code">Kode Produk</label>
                                        <input type="text" class="form-control" id="product_code" name="product_code"
                                            placeholder="Masukkan Kode Produk" @if (!empty($product['product_code']))
                                            value="{{ $product['product_code'] }}" @else
                                            value="{{ @old('product_code') }}" @endif>
                                    </div>
                                    <div class="form-group ">
                                        <label for="product_color">Warna Produk</label>
                                        <input type="text" class="form-control" id="product_color" name="product_color"
                                            placeholder="Masukkan Warna Produk" @if (!empty($product['product_color']))
                                            value="{{ $product['product_color'] }}" @else
                                            value="{{ @old('product_color') }}" @endif>
                                    </div>
                                    @php
                                    $familyColors = \App\Models\Color::colors();
                                    @endphp
                                    <div class="form-group ">
                                        <label for="family_color">Warna Primer</label>
                                        <select name="family_color" class="form-control">
                                            <option value="">Pilihan</option>
                                            @foreach ($familyColors as $color)
                                            <option value="{{ $color['color_name'] }}"
                                                @if(!empty(@old('family_color'))&&
                                                @old('family_color')==$color['color_name'] ) selected=""
                                                @elseif(!empty($product['family_color'])&&$product['family_color']==$color['color_name']
                                                ) selected="" @endif>{{ $color['color_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="group_code">Kode Grup</label>
                                        <input type="text" class="form-control" id="group_code" name="group_code"
                                            placeholder="Masukkan Kode Grup" @if (!empty($product['group_code']))
                                            value="{{ $product['group_code'] }}" @else value="{{ @old('group_code') }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ">
                                        <label for="product_price">Harga Produk</label>
                                        <input type="text" class="form-control" id="product_price" name="product_price"
                                            placeholder="Masukkan Harga Produk" @if (!empty($product['product_price']))
                                            value="{{ $product['product_price'] }}" @else
                                            value="{{ @old('product_price') }}" @endif>
                                    </div>
                                    <div class="form-group ">
                                        <label for="product_discount">Diskon Produk (%)</label>
                                        <input type="text" class="form-control" id="product_discount"
                                            name="product_discount" placeholder="Masukkan Diskon Produk (%)"
                                            @if(!empty($product['product_discount']))
                                            value="{{ $product['product_discount'] }}" @else
                                            value="{{ @old('product_discount') }}" @endif>
                                    </div>
                                    <div class="form-group ">
                                        <label for="product_weight">Berat Produk</label>
                                        <input type="text" class="form-control" id="product_weight"
                                            name="product_weight" placeholder="Masukkan Berat Produk"
                                            @if(!empty($product['product_weight']))
                                            value="{{ $product['product_weight'] }}" @else
                                            value="{{ @old('product_weight') }}" @endif>
                                    </div>
                                    <div class="form-group ">
                                        <label for="fabric">Fabric (Jenis Kain)</label>
                                        <select name="fabric" class="form-control">
                                            <option value="">Pilihan</option>
                                            @foreach ($productsFilters['fabricArray'] as $fabric )
                                            <option @if (!empty(@old('fabric')) && @old('fabric')==$fabric) selected=""
                                                @elseif (!empty($product['fabric']) && $product['fabric']==$fabric)
                                                selected="" @endif value="{{ $fabric }}">{{ $fabric }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="sleeve">Sleeve (Lengan)</label>
                                        <select name="sleeve" class="form-control">
                                            <option value="">Pilihan</option>
                                            @foreach ($productsFilters['sleeveArray'] as $sleeve)
                                            <option @if (!empty(@old('sleeve')) && @old('sleeve')==$sleeve) selected=""
                                                @elseif (!empty($product['sleeve']) && $product['sleeve']==$sleeve)
                                                selected="" @endif value="{{ $sleeve }}">{{ $sleeve }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="pattern">Pattern (Motif)</label>
                                        <select name="pattern" class="form-control">
                                            <option value="">Pilihan</option>
                                            @foreach ($productsFilters['patternArray'] as $pattern)
                                            <option @if (!empty(@old('pattern')) && @old('pattern')==$pattern)
                                                selected="" @elseif (!empty($product['pattern']) &&
                                                $product['pattern']==$pattern) selected="" @endif
                                                value="{{ $pattern }}">{{ $pattern }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="fit">Fit (Keketatan)</label>
                                        <select name="fit" class="form-control">
                                            <option value="">Pilihan</option>
                                            @foreach ($productsFilters['fitArray'] as $fit)
                                            <option @if (!empty(@old('fit')) && @old('fit')==$fit) selected=""
                                                @elseif(!empty($product['fit']) && $product['fit']==$fit) selected=""
                                                @endif value="{{ $fit }}">{{ $fit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="occasion">Occasion (Gaya)</label>
                                        <select name="occasion" class="form-control">
                                            <option value="">Pilihan</option>
                                            @foreach ($productsFilters['occasionArray'] as $occasion)
                                            <option @if (!empty(@old('occasion')) && @old('occasion')==$occasion)
                                                selected="" @elseif (!empty($product['occasion']) &&
                                                $product['occasion']==$occasion) selected="" @endif
                                                value="{{ $occasion }}">{{ $occasion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="product_images">Gambar Produk (disarankan: kurang dari 2 mb)</label>
                                        <input type="file" class="form-control" id="product_images"
                                            name="product_images[]" multiple="">
                                        <table cellpadding="10" cellspacing="10" border="1" style="margin: 10px" ;>
                                            <tr>
                                                @foreach ($product['images'] as $image)
                                                <td style="background-color: #f9f9f9;">
                                                    <a target="_blank"
                                                        href="{{ url('front/images/products/large/'.$image['image']) }}"><img
                                                            style="width: 60px"
                                                            src="{{ asset('front/images/products/small/'.$image['image']) }}"
                                                            alt=""></a>&nbsp;
                                                    <input type="hidden" name="image[]" value="{{ $image['image'] }}">
                                                    <input style="width: 30px;" type="text" name="image_sort[]"
                                                        value="{{ $image['image_sort'] }}">
                                                    <a class="confirmDelete" title="Delete product image"
                                                        href="javascript:void(0)" record="product-image"
                                                        recordid="{{ $image['id'] }}"><i class="fas fa-trash"></i></a>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-group ">
                                        <label for="product_video">Video Produk (disarankan: kurang dari 2 mb)</label>
                                        <input type="file" class="form-control" id="product_video" name="product_video">
                                        @if (!empty($product['product_video']))
                                        <a target="_blank" style="color: white"
                                            href="{{ url('front/videos/products/'.$product['product_video']) }}">Lihat</a>&nbsp;|&nbsp;
                                        <a style="color: white" class="confirmDelete" title="Delete product video"
                                            href="javascript:void(0)" record="product-video"
                                            recordid="{{ $product['id'] }}">Hapus</a> @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="">Atribut Produk</label>
                                        <table style="background-color: #52585e; width: 50%;" cellpadding="5">
                                            <tr>
                                                <th>ID</th>
                                                <th>Ukuran</th>
                                                <th>SKU</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                            @foreach ($product['attributes'] as $attribute)
                                            <input type="hidden" name="attributeId[]" value="{{ $attribute['id'] }}">
                                            <tr>
                                                <td>{{ $attribute['id'] }}</td>
                                                <td>{{ $attribute['size'] }}</td>
                                                <td>{{ $attribute['sku'] }}</td>
                                                <td>
                                                    <input style="width: 100px;" type="number" name="price[]"
                                                        value="{{ $attribute['price'] }}">
                                                </td>
                                                <td>
                                                    <input style="width: 100px;" type="number" name="stock[]"
                                                        value="{{ $attribute['stock'] }}">
                                                </td>
                                                <td>
                                                    @if ($attribute['status']==1)
                                                    <a style="color: #f9f9f9" class="updateAttributeStatus"
                                                        id="attribute-{{ $attribute['id'] }}"
                                                        attribute_id="{{ $attribute['id'] }}"
                                                        href="javascript:void(0)"><i class="fas fa-toggle-on"
                                                            status="Active"></i></a>
                                                    @else
                                                    <a class="updateAttributeStatus"
                                                        id="attribute-{{ $attribute['id'] }}"
                                                        attribute_id="{{ $attribute['id'] }}" style="color:grey"
                                                        href="javascript:void(0)"><i class="fas fa-toggle-off"
                                                            status="Inactive"></i></a>
                                                    @endif
                                                    &nbsp;
                                                    <a style="color: #f9f9f9" class="confirmDelete"
                                                        title="Delete attribute" href="javascript:void(0)"
                                                        record="attribute" recordid="{{ $attribute['id'] }}"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="form-group ">
                                        <label for="">Tambah Atribut Produk</label>
                                        <div class="field_wrapper">
                                            <div>
                                                <input type="text" name="size[]" id="size" placeholder="Ukuran"
                                                    style="width: 120px">
                                                <input type="text" name="sku[]" id="sku" placeholder="Kode SKU"
                                                    style="width: 120px">
                                                <input type="text" name="price[]" id="price" placeholder="Harga"
                                                    style="width: 120px">
                                                <input type="text" name="stock[]" id="stock" placeholder="Stok"
                                                    style="width: 120px">
                                                <a href="javascript:void(0);" class="add_button" title="Add field">
                                                    <i style="color:#f9f9f9" class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="description">Deskripsi Produk</label>
                                        <textarea class="form-control" rows="3" id="description" name="description"
                                            placeholder="Masukkan Deskripsi">@if (!empty($product['description'])){{ $product['description'] }}
                                            @else{{ @old('description') }}@endif</textarea>
                                    </div>
                                    <div class="form-group ">
                                        <label for="wash_care">Petunjuk Cuci</label>
                                        <textarea class="form-control" rows="3" id="wash_care" name="wash_care"
                                            placeholder="Masukkan Keterangan">@if (!empty($product['wash_care'])){{ $product['wash_care'] }}
                                            @else{{ @old('wash_care') }}@endif</textarea>
                                    </div>
                                    <div class="form-group ">
                                        <label for="search_keywords">Kata Kunci Pencarian</label>
                                        <textarea class="form-control" rows="3" id="search_keywords"
                                            name="search_keywords" placeholder="Masukkan Kata Kunci">@if (!empty($product['search_keywords'])){{ $product['search_keywords'] }}
                                            @else{{ @old('search_keywords') }}@endif</textarea>
                                    </div>
                                    <div class="form-group ">
                                        <label for="meta_title">Tag Judul</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            placeholder="Masukkan Tag Judul" @if(!empty($product['meta_title']))
                                            value="{{ $product['meta_title'] }}" @else value="{{ @old('meta_title') }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ">
                                        <label for="meta_description">Tag Deskripsi</label>
                                        <input type="text" class="form-control" id="meta_description"
                                            name="meta_description" placeholder="Masukkan Tag Deskripsi"
                                            @if(!empty($product['meta_description']))
                                            value="{{ $product['meta_description'] }}" @else
                                            value="{{ @old('meta_description') }}" @endif>
                                    </div>
                                    <div class="form-group ">
                                        <label for="meta_keywords">Tag Kata Kunci</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                            placeholder="Masukkan Tag Kata Kunci" @if(!empty($product['meta_keywords']))
                                            value="{{ $product['meta_keywords'] }}" @else
                                            value="{{ @old('meta_keywords') }}" @endif>
                                    </div>
                                    <div class="form-group ">
                                        <label for="is_featured">Produk Unggulan</label>
                                        <input type="checkbox" name="is_featured" value="Yes"
                                            @if(!empty($product['is_featured']) && $product['is_featured']=="Yes" )
                                            checked="" @endif>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="form-group ">
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