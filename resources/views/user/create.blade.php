@extends('app')

@section('content')

<div class="main-content" style="background-color: #f6f6f6; color: #6c757d;">
        <section class="section">
            <div class="section-body">
                <div class="form-container">
                    <h2>Create New User</h2>
                    <form id="createForm" action="" method="POST">
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
                        <div class="form-group">
                            <button type="submit">Submit</button>
                            <a href="/user" class="back-button">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
<script>
     document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('#createForm').addEventListener('submit', function(event){
            event.preventDefault();
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const data = {
                name: name,
                email: email,
                password: password,
            }

            fetch('/api/store', {
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
                if(data){
                    swal({
                    title: "Good job!",
                    text: data.message,
                    icon: "success",
                    button: "Ok",
                    }).then(() => {
                        window.location.href = '/user';
                    })
                }
            })
        })
     })
</script>
@endsection