@extends('app')

@section('content')

<div class="main-content" style="background-color: #f6f6f6; color: #6c757d;">
        <section class="section">
            <div class="section-body">
                <div class="form-container">
                    <h2>Create New User</h2>
                    <form id="createFormElement" action="" method="POST">
                        <div class="form-group">
                            <label for="profile_img">Profile:</label>
                            <input type="file" id="profile_img" name="profile_img">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
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
        document.querySelector('#createFormElement').addEventListener('submit', function(event){
            event.preventDefault();
            
            const formElement = document.getElementById('createFormElement');
            const formData = new FormData(formElement);

            fetch('/api/store', {
                method: 'POST',
                headers: {
                    Authorization: 'Bearer ' + token
                },
                body: formData, 
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