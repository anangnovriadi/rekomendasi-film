@extends('front.layout.app')

@section('title', 'List Film')

@section('name')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />    
@endsection

@section('content')

<div class="container-cus">
    <div class="pb-4">
        <h4 class="gray-g">Detail Film <b>{{ $film->nama_film }}</b></h4>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img class="img-responsive card-s" style="max-height: 414px;min-height: 414px;" src="{{ asset('admin/'.$film->image_film) }}">            
        </div>
        <div class="col-md-8">
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Nama film:</strong> {{ $film->nama_film }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Genre:</strong> {{ $film->genre }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Aktor/Aktris:</strong> {{ $film->aktor_aktris }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Tahun:</strong> {{ $film->tahun }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Negara:</strong> {{ $film->negara }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Produksi:</strong> {{ $film->produksi }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Deskripsi:</strong> {{ $film->deskripsi_film }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection