@extends('app')

@section('content')

<div class="main-content" style="background-color: #f6f6f6; color: #6c757d;">
        <section class="section">
            <div class="section-body">
                <div class="form-container">
                    <h2>Create New User</h2>
                    <form id="createFormElement" action="" method="POST">
                    <div class="form-group">
                        <label>Profile</label>
                        <input type="file" name="profile_img" class="form-control" id="profile_img">
                    </div>
                    <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" id="email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id="phone_number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" id="address">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="" selected disabled>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-select">
                                        <option value="" selected disabled>Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widow">Widow</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                            </div>
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
                if(data.status){
                    swal({
                    title: "Good job!",
                    text: data.message,
                    icon: "success",
                    button: "Proceed",
                    }).then(() => {
                        window.location.href = '/user';
                    })
                } else {
                    swal({
                        title: "Oops",
                        text: "Something wrong with your information,\ncheck in the console if there's a error!",
                        icon: "error",
                        button: "Ok",
                    });
                }
            })
        })
     })
</script>
@endsection