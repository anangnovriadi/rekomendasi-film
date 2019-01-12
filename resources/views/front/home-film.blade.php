@extends('front.layout.app')

@section('title', 'Home')

@section('content')
    <div class="container-cus">
        <div class="pb-4">
            <h4 class="gray-g">Rekomendasi untuk anda</h4>
        </div>
        <div class="row">
            @foreach ($take as $value => $key)
            <div class="col-md-3 mb-4">
                <div class="card card-s">
                    <img class="card-img-top card-top-cus" src="{{ asset('admin/'.$key[0]->image_film) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title max-elips mb-2">{{ $key[0]->nama_film }}</h5>
                        <div class="d-flex">
                            <div class="mb-2">
                                <span class="badge badge-success">{{ $key[0]->genre }}</span>
                            </div>
                            <div class="ml-auto">
                                <span><img src="{{ asset('front/img/star.png') }}" /> {{ $key[0]->rating }} / 10</span>
                            </div>
                        </div>                        
                        <p class="card-text max-text">{{ $key[0]->deskripsi_film }}</p>
                        <a href="/detail-film/{{ $key[0]->nama_slug }}" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection