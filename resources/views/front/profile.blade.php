@extends('front.layout.app')

@section('title', 'Profile')

@section('content')

<div class="container-cus">
    <div class="pb-4">
        <h4 class="gray-g">My Profile</h4>
    </div>
    <form>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" value="anangnov99@gmail.com" placeholder="Enter email" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Firstname</label>
                    <input type="text" class="form-control" value="Anang" placeholder="Enter Firstname">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Lastname</label>
                    <input type="text" class="form-control" value="Novriadi" placeholder="Enter Lastname">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Film(Liked)</label>
                    <input type="text" class="form-control" value="avatar" placeholder="Enter Nama Film(Liked)">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Genre Film(Liked)</label>
                    <input type="text" class="form-control" value="action" placeholder="Enter Genre Film(Liked)">
                </div>
            </div>
        </div>
        <div class="pt-3">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit Profile</button>
            </div>
        </div>
    </form>
</div>
@endsection