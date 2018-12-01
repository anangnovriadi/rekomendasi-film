@extends('admin.auth.layout.app')

@section('content')
<div class="login-register" style="opacity: 1; background-image: url(https://lh4.googleusercontent.com/proxy/cuUbbMP9rKYZklh_uD7k1IyNKv-xyABaITwFWYSElNO7PR-Sce8MqryijVuo9o-QTKOypVHu1kGN6jN2UgVYd_g0AlwGBuytF-Kplw=w3840-h2160-p-k-no-nd-mv)">
    <div class="login-box card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.login') }}" class="form-horizontal form-material">
                {{ csrf_field() }}
                <h3 class="box-title m-b-20">Sign In Admin Rekomendasi Film</h3>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="username" type="text" required placeholder="Username"> </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="password" type="password" required placeholder="Password"> </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 font-14">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup"> Remember me </label>
                        </div> </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection