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
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpInline" placeholder="Password">
            </div>
            <button type="button" class="btn btn-primary btn-wider" id="button_click">Login</button>
            <p class="text-sm mt-4 text-center">Don't have an account? <a href="#" for="login" class="text-indigo-500 cursor-pointer">Register Here</a></p>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('#button_click').addEventListener('click', function(event){
            event.preventDefault();

            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            const data = {
                email: email,
                password: password,
            }

            fetch('/api/login', {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => {
                return res.json();
            })
            .then(res => {
                console.log(res);
                if(res.access_token)
                {
                    localStorage.setItem('token', res.access_token);
                    window.location.href = '/home';
                } else {
                    const messageElement = document.getElementById('message');
                    messageElement.innerHTML = res.message;
                    messageElement.style.display = 'block'; 
                    messageElement.style.textAlign = 'left'; 
                }
            })
        })
    })
</script>

</body>
</html>
