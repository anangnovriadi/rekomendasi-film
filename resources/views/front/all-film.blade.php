@extends('front.layout.app')

@section('title', 'Film')

@section('content')

<div class="container-cus">
    <div class="pb-4">
        <h4 class="gray-g">Semua Daftar Film</h4>
    </div>
    <div class="row">
        @foreach ($all as $value)
        <div class="col-md-3 mb-4">
            <div class="card card-s">
                <img class="card-img-top card-top-cus" src="{{ asset('admin/images/big/img6.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $value->nama_film }}</h5>
                    <p class="card-text">{{ $value->deskripsi_film }}</p>
                    <a href="#" class="btn btn-primary">Read more</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection