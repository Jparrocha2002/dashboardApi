@extends('home')

@section('content')

<div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="content">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center mb-4">
                                <h1 class="user-title">User</h1>
                                <a href="/user/create"><button class="button-click">Add New</button></a>
                            </div>
                            <div class="card-body" style="padding-top: 20px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
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
            headers: {
                Accept: 'application/json',
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
                            <td>${data[i].name}</td>        
                            <td>${data[i].email}</td> 
                            <td>
                                <button class="edit-button">
                                    <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                                </button>

                                <button class="delete-button">
                                    <i class="fas fa-trash-alt"></i> <!-- Font Awesome delete icon -->
                                </button>
                            </td>       
                        `;
                    tablebody.innerHTML += body;
            }

        })
    </script>

@endsection