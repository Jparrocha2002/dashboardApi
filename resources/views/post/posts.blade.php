@extends('app')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
  .post-container {
    margin-bottom: 20px;
  }
  .post-container h2 {
    margin-bottom: 20px;
  }
  .card {
    margin: 20px;
  }
  .pagebtn {
    text-align: center;
    margin-top: 20px;
  }
  .pagebtn button {
    margin: 0 10px;
  }
  .material-icons.show-icon {
    color: blue; /* Change to your desired color */
    margin-right: 10px;
  }
  .material-icons.delete-icon {
    color: red; /* Change to your desired color */
    margin-right: 10px;
  }
</style>

    <!-- <div class="main-content" id="commentdiv">
    <div class="post-container">
        <div class="card">
        <div class="card-header">
            <h2>Add Comment</h2>
        </div>
        <div class="card-body">
            <h5 id="message" class="text-danger"></h5>
            <form id="commentform">
            <textarea id="comment" name="comment" class="form-control" placeholder="Type your comment here..." rows="4"></textarea><br>
            <button type="submit" class="btn btn-primary">Comment</button>
            </form>
        </div>
        </div>
    </div>
    </div> -->

<div class="main-content" id="postform">
  <div class="post-container">
    <div class="card">
      <div class="card-header">
        <h2>Create Post</h2>
      </div>
      <div class="card-body">
        <h5 id="message" class="text-danger"></h5>
        <form id="contentform">
          <textarea id="content" name="content" class="form-control" placeholder="Type your post here..." rows="4"></textarea><br>
          <button type="submit" class="btn" style="background-color: #051e37; color: #fff;">Post</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="main-content" id="allpostform">
  <div class="post-container">
    <h2 class="text-center">All Posts</h2>
    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Posted By</th>
          <th scope="col">Content</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="poststable">
        <!-- Posts will be inserted here by JavaScript -->
      </tbody>
    </table>
    <div class="pagebtn">
      <button id="prevpage" class="btn btn-sm" style="background-color: #051e37; color: #fff;">Prev Page</button>
      <span id="pageinfo"></span>
      <button id="nextpage" class="btn btn-sm" style="background-color: #051e37; color: #fff;">Next Page</button>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;

    function fetchposts(page) {
      fetch(`http://127.0.0.1:8000/api/allposts?page=${page}`, {
        method: 'GET',
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token'),
        }
      })
      .then(res => res.json())
      .then(data => {
        console.log(data);
        // Clear existing table rows
        document.getElementById('poststable').innerHTML = '';

        data.data.forEach(post => {
          const row = `
            <tr>
              <td>${post.username}</td>
              <td>${post.content}</td>
              <td style='width: 180px;'>
                <a class='show' title='Show' href='/comments/${post.id}'><i class='material-icons show-icon'>visibility</i></a>
                <a class='delete' title='Delete' onclick='deleteUser(${post.id})'><i class='material-icons delete-icon'>delete</i></a>
              </td>
            </tr>`;
          document.getElementById('poststable').innerHTML += row;
        });

        // Update page information
        document.getElementById('pageinfo').innerText = `Page ${currentPage}`;
      })
      .catch(error => {
        console.error('Something went wrong with your fetch!', error);
      });
    }

    // Initial fetch for the first page
    fetchposts(currentPage);

    // Event listener for next page button
    document.getElementById('nextpage').addEventListener('click', function() {
      currentPage++;
      fetchposts(currentPage);
    });

    // Event listener for previous page button
    document.getElementById('prevpage').addEventListener('click', function() {
      if (currentPage > 1) {
        currentPage--;
        fetchposts(currentPage);
      }
    });
  });

  document.getElementById('contentform').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("http://127.0.0.1:8000/api/createpost", {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      },
      body: formData,
    })
    .then(res => {
      if (!res.ok) {
        throw new Error('Network response was not ok');
      }
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
            window.location.reload();
        })
      } else {
        alert("Post unsuccessful!");
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
</script>

@endsection
