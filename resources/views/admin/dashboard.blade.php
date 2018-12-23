@extends('admin.layout.app')

@section('pageTitle', 'Dashboard')

@section('content')

<div id="main-wrapper">
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Dashboard</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row page-titles" style="background: #1976d2 no-repeat center top">
                <div class="col-lg-12 text-center">
                    <h1 class="m-t-30" style="color: white;">Rekomendasi Film</h1>
                    <h5 class="m-b-30" style="color: rgba(255, 255, 255, 0.65);"><i class="ti-pin"></i> Welcome to Admin Rekomendasi Film</h5>
                </div>
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
</div>

@endsection