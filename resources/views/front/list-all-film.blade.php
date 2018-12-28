@extends('front.layout.app')

@section('title', 'List Film')

@section('name')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />    
@endsection

@section('content')

<div class="container-cus">
    <div class="pb-4">
        <h4 class="gray-g">Semua Daftar Film</h4>
    </div>
    <div class="row">
        @foreach ($all as $value)
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
    <div class="page-cus pt-4">
        {{ $all->links() }}
    </div>
</div>
@endsection