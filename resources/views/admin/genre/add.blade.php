@extends('admin.layout.app')

@section('pageTitle', 'Genre Film')

@section('content')

<div id="main-wrapper">
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Genre</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah</a></li>
                    <li class="breadcrumb-item active">Genre</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline-info">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Tambah Genre</h4>
                        </div>
                        <div class="card-body">
                            <form action={{ route('create.genre') }} method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-body">
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Genre</label>
                                                        <input type="text" name="nama_genre" class="form-control" placeholder="Nama Genre">
                                                        @if($errors->first('nama_genre'))
                                                            <div class="mb-3">
                                                                <small class="form-control-feedback" style="color: red">{{ $errors->first('nama_genre') }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Save</button>
                                    <a href={{ route('view.genre') }}><button type="button" class="btn btn-inverse">Cancel</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
</div>

@endsection