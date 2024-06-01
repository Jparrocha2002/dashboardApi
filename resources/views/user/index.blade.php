@extends('app')

@section('content')

<div class="main-content" style="background-color: #f6f6f6; color: #6c757d;">
        <section class="section">
            <div class="section-body">
                <div class="content">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center mb-4">
                                <h3 class="user-title">User</h3>
                                <a href="/user/create"><button class="button-click">Add New</button></a>
                            </div>
                            <div class="card-body" style="padding-top: 5px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablebody">
                                            <tr>
                                            
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        fetch('/api/users', {
            method: 'GET',
            headers: {
                Authorization: 'Bearer ' + token
            }
        })
        .then(res => {
            console.log(res.responseType);
            console.log(res);

            return res.json();
        })
        .then(data => {
            console.log(data);

            const tablebody = document.getElementById('tablebody'); 

            tablebody.innerHTML = '';

            for(let i = 0; i < data.length; i++)
            {
                const body = `<td>${data[i].id}</td>        
                            <td style="display: flex; justify-content: center; align-items: center;">
                            <img src="storage/${data[i].profile_img}" alt="avatar" style="width: 45px; height:45px;" class="img-profile rounded-circle">
                            </td>
                            <td>${data[i].name}</td>        
                            <td>${data[i].email}</td> 
                            <td>
                            <a class='edit' title='Edit' href="/user/update/${data[i].id}">
                                <button class="edit-button" style="background-color: yellow; font-size: 0.8rem;">
                                <i class="fas fa-pencil-alt"></i> <!-- Font Awesome pencil icon -->
                                </button>
                            </a>
                                <button class="delete-button" onclick="deleteUser(${data[i].id})" style="background-color: red; font-size: 0.8rem;">
                                    <i class="fas fa-trash-alt"></i> <!-- Font Awesome delete icon -->
                                </button>
                            </td>       
                        `;
                    tablebody.innerHTML += body;
            }

        })

        function deleteUser(userId) {
            swal({
            title: "Delete Confimation",
            text: "Are you sure you want to delete this user?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then(willDelete => {
            if(willDelete)
            {
                fetch(`/api/users/delete/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token
                        }
                    })
                    .then(res => {
                        return res.json();
                    })
                    .then(data => {
                        if(data.status) {
                            swal({
                        title: "Good job!",
                        text: data.message,
                        icon: "success",
                        button: "Proceed",
                        }).then(() => {
                            window.location.href = '/user';
                    })
                        } else {
                            alert('Failed to delete user.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
            
        }
    </script>

@endsection