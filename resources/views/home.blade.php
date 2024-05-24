@extends('app')

@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="content">
                    <h3>Welcome to my dashboard</h3>

                    <!-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="row w-100">
                                    <div class="col-6 pt-3">
                                        <div class="card-content">
                                            <h5 class="fs-6">Admin</h5>
                                            <h2 class="mb-3 fs-5" id="count"></h2>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="banner-img">
                                            <img src="" alt="Admin" class="img-fluid" style="max-width: 70%; height: auto; max-height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                </div>
            </div>
        </section>
    </div>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = localStorage.getItem('token'); 

            fetch('/api/users/count', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log(data);
                document.getElementById('count').textContent = data.count;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });
    </script> -->
@endsection