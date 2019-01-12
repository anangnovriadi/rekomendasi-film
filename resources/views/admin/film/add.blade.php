@extends('admin.layout.app')

@section('pageTitle', 'Add Film')

@section('content')

<div id="main-wrapper">
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Film</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah</a></li>
                    <li class="breadcrumb-item active">Film</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline-info">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Tambah Film</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.film') }}" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-body">
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Nama</label>
                                                        <input type="text" name="nama_film" class="form-control" placeholder="Nama Film">
                                                        @if($errors->first('nama_film'))
                                                            <div class="mb-3">
                                                                <small class="form-control-feedback" style="color: red">{{ $errors->first('nama_film') }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-body">
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Genre</label>
                                                        <input type="text" name="genre" class="form-control" placeholder="Genre Film">
                                                        @if($errors->first('genre'))
                                                            <div class="mb-3">
                                                                <small class="form-control-feedback" style="color: red">{{ $errors->first('genre') }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-body">
                                            <div class="row p-t-10">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Aktor/Aktris</label>
                                                        <input type="text" name="aktor_aktris" class="form-control" placeholder="Aktor dan Aktris">
                                                        @if($errors->first('aktor_aktris'))
                                                            <div class="mb-3">
                                                                <small class="form-control-feedback" style="color: red">{{ $errors->first('aktor_aktris') }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-body">
                                            <div class="row p-t-10">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Tahun</label>
                                                        <input type="text" name="tahun" class="form-control" placeholder="Tahun Rilis">
                                                        @if($errors->first('tahun'))
                                                            <div class="mb-3">
                                                                <small class="form-control-feedback" style="color: red">{{ $errors->first('tahun') }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-body">
                                            <div class="row p-t-10">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Negara</label>
                                                        <input type="text" name="negara" class="form-control" placeholder="Negara">
                                                        @if($errors->first('negara'))
                                                            <div class="mb-3">
                                                                <small class="form-control-feedback" style="color: red">{{ $errors->first('negara') }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-body">
                                            <div class="row p-t-10">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Produksi</label>
                                                        <input type="text" name="produksi" class="form-control" placeholder="Perusahaan Pembuat">
                                                        @if($errors->first('produksi'))
                                                            <div class="mb-3">
                                                                <small class="form-control-feedback" style="color: red">{{ $errors->first('produksi') }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-body">
                                            <div class="row p-t-10">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Rating</label>
                                                        <input type="text" name="rating" class="form-control" placeholder="Rating">
                                                        @if($errors->first('negara'))
                                                            <div class="mb-3">
                                                                <small class="form-control-feedback" style="color: red">{{ $errors->first('rating') }}</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-body">
                                            <div class="row p-t-10">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Input Select</label>
                                                        <select name="type_movie" class="custom-select col-12">
                                                            <option value="" selected="">Choose...</option>
                                                            <option value="coming soon">Coming Soon</option>
                                                            <option value="realesed">Realesed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="row p-t-10">
                                        <div class="col-12">
                                            <label class="card-title">Gambar Film</label>
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="image_film" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="row p-t-10">
                                        <div class="col-12">
                                            <label class="card-title">Deskripsi Film</label>
                                            <div class="form-group">
                                                <textarea class="form-control" name="deskripsi_film" rows="5" placeholder="Enter text ..."></textarea>
                                                @if($errors->first('deskripsi_film'))
                                                    <div class="mb-3">
                                                        <small class="form-control-feedback" style="color: red">{{ $errors->first('deskripsi_film') }}</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Save</button>
                                    <button type="button" class="btn btn-inverse">Cancel</button>
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