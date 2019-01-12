@extends('front.layout.app')

@section('title', 'List Film')

@section('name')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />    
@endsection

@section('content')

<div class="container-cus">
    <div class="pb-4">
        <h4 class="gray-g">Coming Soon Film</h4>
    </div>
    <div class="row">
        @foreach ($coming as $value)
        <div class="col-md-3 mb-4">
            <div class="card card-s">
                <img class="card-img-top card-top-cus" src="{{ asset('admin/'.$value->image_film) }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title max-elips mb-2">{{ $value->nama_film }}</h5>
                    <div class="d-flex">
                        <div class="mb-2">
                            <span class="badge badge-success">{{ $value->genre }}</span>
                        </div>
                        <div class="ml-auto">
                            <span><img src="{{ asset('front/img/star.png') }}" /> {{ $value->rating }} / 10</span>
                        </div>
                    </div>
                    <p class="card-text max-text">{{ $value->deskripsi_film }}</p>
                    <a href="/detail-film/{{ $value->nama_slug }}" class="btn btn-primary">Read more</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection