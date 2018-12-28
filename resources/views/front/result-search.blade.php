@extends('front.layout.app')

@section('title', 'Result Film')

@section('content')

<div class="container-cus">
    <div class="pb-4">
        <h4 class="gray-g">Hasil Pencarian Film '{{ $query }}'</h4>
    </div>
    @if(count($film) > 0)
        <div class="row">
            @foreach ($film as $value)
            <div class="col-md-3 mb-4">
                <div class="card card-s">
                    <img class="card-img-top card-top-cus" src="{{ asset('admin/'.$value->image_film) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title max-elips mb-2">{{ $value->nama_film }}</h5>
                        <div class="mb-2">  
                            <span class="badge badge-success">{{ $value->genre }}</span>
                        </div>
                        <p class="card-text max-text">{{ $value->deskripsi_film }}</p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center" style="padding-top: 156px; padding-bottom: 156px;">
            <h4 class="gray-g">Data tidak ditemukan</h4>
        </div>
    @endif
    
</div>
@endsection