<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form id="loginFormElement" class="login-form" action="" method="POST">
            <img src="{{ asset('assets/img/icon.webp') }}" alt="User Icon" class="user-icon">
            <div id="message" class="alert-message"></div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Password</label>
                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpInline" placeholder="Password">
            </div>
            <button type="button" class="btn btn-primary btn-wider">Login</button>
            <p class="text-sm mt-4 text-center">Don't have an account? <a href="#" for="login" class="text-indigo-500 cursor-pointer">Register Here</a></p>
        </form>
    </div>
</body>
</html>
