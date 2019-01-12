@extends('front.layout.app')

@section('title', 'Home')
{{-- @php
dd($pop)
@endphp --}}
@section('content')
    <div class="container-cus pb-0">
        <div class="pb-4">
            <h4 class="gray-g">Film terpopuler</h4>
        </div>
        <div id="carouselExample" class="carousel slide row" data-ride="carousel" data-interval="9000">
            <div class="carousel-inner row w-100 mx-auto" role="listbox">
                @foreach ($popOne as $item)
                    <div class="carousel-item col-md-3 active">
                        <div class="panel panel-default">
                           <div class="panel-thumbnail">
                            <a href="#" title="image 1" class="thumb">
                               <img style="max-height: 320px; width: 100%" class="img-fluid mx-auto d-block" src="{{ asset('admin/'.$item->image_film) }}" alt="slide 1">
                            </a>
                           </div>
                         </div>
                     </div>
                @endforeach
                @foreach ($pop as $item)
                    <div class="carousel-item col-md-3">
                        <div class="panel panel-default">
                           <div class="panel-thumbnail">
                            <a href="#" title="image 1" class="thumb">
                               <img style="max-height: 320px; width: 100%" class="img-fluid mx-auto d-block" src="{{ asset('admin/'.$item->image_film) }}" alt="slide 1">
                            </a>
                           </div>
                         </div>
                     </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    
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
                    <div class="mb-2">
                        <span class="badge badge-secondary">Rekomendasi by nama film</span>
                    </div>
                    <h5 class="card-title max-elips mb-2">{{ $key[0]->nama_film }}</h5>
                    <div class="mb-2">
                        <span class="badge badge-success">{{ $key[0]->genre }}</span>
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