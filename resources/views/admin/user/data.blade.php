@extends('admin.layout.app')

@section('pageTitle', 'User')

@section('content')

<div id="main-wrapper">
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Data User</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Data User</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data User </h4>
                            <h6 class="card-subtitle">Daftar semua user yang terdaftar</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                            <th>Register</th>
                                            <th>Nama Film(Liked)</th>
                                            <th>Genre Film(Liked)</th>
                                            <th>Deskripsi Film(Liked)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($user as $item)
                                        <tr>
                                            <td><a>{{ $no }}</a></td>
                                            <td>{{ $item->firstname }}</td>
                                            <td>{{ $item->lastname }}</td>
                                            <td style="word-break: break-all; width: 14%;">{{ $item->email }}</td>
                                            <td style="width: 14%;"><span class="text-muted"><i class="fa fa-clock-o"></i> {{ $item->created_at->diffForHumans() }}</span> </td>
                                            <td>{{ $item->nama_film_liked }}</td>
                                            <td>{{ $item->genre_film_liked }}</td>
                                            <td>{{ $item->deskripsi_film_liked }}</td>
                                        </tr>
                                        @php $no++ @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
</div>
@endsection