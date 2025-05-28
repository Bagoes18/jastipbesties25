@extends('front.layout.layout')
@section('content')
@section('title')
{{ $detailcontent->meta_title ?? $detailcontent->title }}
@endsection

@section('meta_description', $detailcontent->meta_description)
@section('meta_keywords', $detailcontent->meta_keywords)

@section('content')
<!-- Breadcrumb -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('front/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>{{ $detailcontent->title }}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ url('/') }}">Home</a>
                        <span>{{ $detailcontent->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<section class="cms-content spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cms__details">
                    {!! $detailcontent->description !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection