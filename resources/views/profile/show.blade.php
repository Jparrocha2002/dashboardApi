@extends('app')

@section('content')

<div class="main-content" style="background-color: #f6f6f6; color: #6c757d;">
    <section class="section">
        <div class="section-body">
            <div class="container">
                <div class="form-container">
                    <h2>Profile Information</h2>
                    <form id="profileForm" action="" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 d-flex align-items-end">
                                <a href="/user" class="btn btn-secondary w-100">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    fetch('/api/users', {
        method: 'GET',
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token'),
            Accept: 'application/json',
        }
    })
    .then(res => {
        return res.json();
    }).then(data => {
        document.getElementById('name').textContent = data.name;
        document.getElementById('email').textContent = data.email;
    })
</script>
@endsection