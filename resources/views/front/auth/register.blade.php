<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <title>Rekomendasi Film - Form Login</title>
</head>
<body>
    <div>
        <div class="content-inner shadow m-auto">
            <div class="mt-5">
                <div class="head-content text-center">
                    <h4 class="white">Register@Rekomendasi Film</h4>    
                </div>
                <div class="content">
                    <div class="wrap-content">
                        <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname">
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Enter Lastname">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label>Nama Film Yang Disukai</label>
                                <input type="text" name="nama_film_liked" class="form-control" placeholder="Enter Nama Film Yang Disukai">
                            </div>
                            <div class="form-group">
                                <label>Genre Yang Disukai</label>
                                <input type="text" name="genre_film_liked" class="form-control" placeholder="Enter Genre Yang Disukai">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Film</label>
                                <input type="text" name="deskripsi_film_liked" class="form-control" placeholder="Enter Deskripsi Film">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <div class="pt-4">
                                <span>
                                    <p class="gray">Sudah punya akun, login <a href="/login">disini</a></p>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>