@extends('front.layout.app')

@section('title', 'List Film')

@section('name')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />    
@endsection

@section('content')

<div class="container-cus">
    <div class="pb-4">
        <h4 class="gray-g">Detail Film <b>{{ $film[0]->nama_film }}</b></h4>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img class="img-responsive card-s" style="max-height: 500px; min-height: 500px;" src="{{ asset('admin/'.$film[0]->image_film) }}">            
        </div>
        <div class="col-md-8">
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Nama film:</strong> {{ $film[0]->nama_film }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Genre:</strong> {{ $film[0]->genre }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Aktor/Aktris:</strong> {{ $film[0]->aktor_aktris }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Tahun:</strong> {{ $film[0]->tahun }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Negara:</strong> {{ $film[0]->negara }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Produksi:</strong> {{ $film[0]->produksi }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Rating:</strong> {{ $film[0]->rating }}
                </div>
            </div>
            <div class="pb-1">
                <div class="alert alert-primary p-2" role="alert">
                    <strong class="gray-g">Deskripsi:</strong> {{ $film[0]->deskripsi_film }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection