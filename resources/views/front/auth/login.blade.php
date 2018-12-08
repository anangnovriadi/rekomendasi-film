<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Rekomendasi Film - Form Login</title>
</head>
<body>
    <div>
        <div class="content-inner shadow m-auto">
            <div class="mt-5">
                <div class="head-content text-center">
                    <h4 class="white">Login@Rekomendasi Film</h4>    
                </div>
                <div class="content">
                    <div class="wrap-content">
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Username</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                            </div>
                            <button type="submit" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading" class="btn btn-primary">Submit</button>
                            <div class="pt-4">
                                <span>
                                    <p class="gray">Belum punya akun, register <a href="/register">disini</a></p>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $('.btn').on('click', function() {
            var $this = $(this);
            $this.button('loading');
        });
    </script>
</body>
</html>