@extends('app')

@section('content')

<div class="main-content" style="background-color: #f6f6f6; color: #6c757d;">
    <section class="section">
        <div class="section-body">
            <div class="container">
                <div class="form-container">
                    <h2>Profile Information</h2>
                    <div class="row justify-content-center align-items-center" style="margin-bottom: 10px;">
                        <div class="col-auto text-center">
                            <img src="{{ asset('assets/img/icon.webp') }}" id="profile_img" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px;">
                            <div style="margin-top: 5px;"><strong>Profile Picture</strong></div>
                        </div>
                    </div>
                    <form id="profileForm" action="" method="POST">
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
                                    <input type="text" name="gender" class="form-control" id="gender">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" name="status" class="form-control" id="status">
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
    fetch('/api/getUser', {
        method: 'GET',
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token'),
            Accept: 'application/json',
        }
    })
    .then(res => {
        return res.json();
    }).then(data => {
        console.log(data);
        document.getElementById('name').value = data.name;
        document.getElementById('email').value = data.email;
        document.getElementById('address').value = data.address;
        document.getElementById('phone_number').value = data.phone_number;
        document.getElementById('gender').value = data.gender;
        document.getElementById('status').value = data.status;
        document.getElementById('profile_img').src = "{{ asset('storage/') }}" + "/" + data.profile_img;
    })
</script>
@endsection