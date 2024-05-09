@extends('app')

@section('content')

<div class="main-content" style="background-color: skyblue;">
        <section class="section">
            <div class="section-body">
                <div class="form-container">
                    <h2>Create New User</h2>
                    <form id="createForm" action="" method="POST" onclick="maintenance()">
                        <div class="form-group">
                            <label for="first_name">Name:</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password">
                        </div>
                    </form>
                    <div class="form-group">
                        <button type="submit">Submit</button>
                        <a href="/user" class="back-button">Back</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

<script>
     document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('#createForm').addEventListener('submit', function(event){
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const data = {
                name: name,
                email: email,
                password: password,
            }

            fetch('/user/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data), 
            })
            .then(res => {
                return res.json();
            })
            .then(data => {
                console.log(data);
                alert(data.message);
                if(data.message == 'User registered successfully')
                {
                    window.location.href = '/home';
                }
                
            })
        })
     })

     function maintenance()
     {
        alert('Under maintenance, sorry for the inconvenience.');
     }
</script>
@endsection