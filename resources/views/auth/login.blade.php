<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>
    @include('link')
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-4">
                <h1>Login Admin</h1>
                <p>Email : email@example.com <br>Password : password</p>
            </div>
            <div class="col-md-4 col-sm-12 px-3 shadow rounded px-4">
                <div class="d-flex justify-content-center align-items-center my-4">
                    <img src="https://st2.depositphotos.com/1768926/10264/v/950/depositphotos_102644096-stock-illustration-community-care-logo-template.jpg\" alt=""
                        width="165" style="border-radius:10px 20px 30px 40px;" class="px-2">
                </div>
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                    @endif
                    <div class="input-control my-2">
                        <label for="email">Email : </label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="input-control my-2">
                        <label for="password">Password :</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div style="float: right;">
                        <button type="submit" class="btn btn-outline-primary my-4 px-4 py-2">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@include('script')
</html>