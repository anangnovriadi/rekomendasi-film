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
                    <h4 class="white">Login@Rekomendasi Film</h4>    
                </div>
                <div class="content">
                    <div class="wrap-content">
                        <form>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>