@extends('admin.layout.app')

@section('pageTitle', 'All Genre')

@section('content')

<div id="main-wrapper">
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Data Genre</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Genre</a></li>
                    <li class="breadcrumb-item active">Data Genre</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <div class="card-body pt-0">
                            <h4 class="card-title">Data Genre</h4>
                            <div class="pt-2">
                                <a href="{{ route('add.genre') }}">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data Genre Film</button>
                                </a>
                            </div>
                            <div class="pt-4">
                                <div class="row el-element-overlay">
                                    @foreach ($genre as $row)
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="el-card-item">
                                                    <div class="el-card-avatar el-overlay-1"> 
                                                        <img src="https://via.placeholder.com/200" alt="user">
                                                    </div>
                                                    <div class="el-card-content">
                                                        <h3 class="box-title">{{ $row->nama_genre }}</h3> <small>{{ $row->nama_genre }} Movie</small>
                                                        <br> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
</div>

@endsection