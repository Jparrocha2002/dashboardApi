@extends('app')

@section('content')

<div class="main-content" style="background-color: #f6f6f6; color: #6c757d;">
    <section class="section">
        <div class="section-body">
            <div class="container">
                <div class="form-container">
                    <h2>Update Information</h2>
                    <form id="editFormElement">
                        <div class="row justify-content-center align-items-center" style="margin-bottom: 10px;">
                            <div class="col-auto text-center">
                                <img src="{{ asset('assets/img/icon.webp') }}" id="profile_img" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" name="profile_img" class="form-control" id="profile_img">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id="phone_number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" id="address">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-select" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-select" id="status">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widow">Widow</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="/user" class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const userid = window.location.pathname.split('/').pop();

    fetch(`http://127.0.0.1:8000/api/users/${userid}`, {
        method: 'GET',
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
        }
    })
    .then((res)=> {
        return res.json();
    })
    .then(data => {
        document.getElementById('name').value = data.name || '';
        document.getElementById('email').value = data.email || '';
        document.getElementById('phone_number').value = data.phone_number || '';
        document.getElementById('address').value = data.address || '';
        document.getElementById('gender').value = data.gender || '';
        document.getElementById('status').value = data.status || '';
        document.getElementById('profile_img').src = "{{ asset('storage/') }}" + "/" + data.profile_img || '';
    })
    .catch(error =>{
        console.error('Failed to fetch user information:', error.message);
    });

    document.getElementById('editFormElement').addEventListener('submit', function(event){
        event.preventDefault();
        const formData = new FormData(this);

        fetch(`http://127.0.0.1:8000/api/users/update/${userid}`, {
            method: 'POST',
            body: formData,
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(res =>{
            return res.json();
        })
        .then(data => {
            console.log(data);
            if (data.status) {
                swal({
                    title: "Success!",
                    text: data.message,
                    icon: "success",
                    button: "Ok",
                }).then(() => {
                    window.location.href = '/user';
                });
            } else {
                swal("Error", data.error, "error");
            }
        })
        .catch(error =>{
            console.error('Failed to update user information:', error.message);
            swal("Oops!", "Failed to update user information", "error");
        });
    });
});



</script>

@endsection
