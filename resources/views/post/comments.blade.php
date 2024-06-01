@extends('app')

@section('content')

<style>
  .comment {
    margin-bottom: 10px;
  }
  .comment p {
    margin: 0;
  }
  .comment.right {
    text-align: right;
  }
</style>

<div class="main-content">
  <div class="chat">
    <!-- Header -->
    <div class="top">
      <div>
        <h4>Posted by: <span id="username"></span></h4>
        <input type="text" id="userkey" name="userkey" hidden>
        <h6 id="content" class="pt-2"></h6>
      </div>
    </div>
    <!-- End Header -->

    <!-- Chat -->
    <div class="messages">
      @include('post/receive', ['message' => "Hey! What's up!  👋"])
    </div>
    <!-- End Chat -->

    <!-- Footer -->
    <div class="bottom">
      <form id="commentform">
        <input type="text" id="message" name="message" placeholder="Enter comment..." autocomplete="off">
        <button id="submitform" type="submit">Send</button>
      </form>
    </div>
    <!-- End Footer -->
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const postid = window.location.pathname.split('/').pop();
  const userid = document.getElementById('userkey').value;

  function createComment() {
    const postid = window.location.pathname.split('/').pop();
    const userid = document.getElementById('userkey').value;
    const comment = document.getElementById('message').value;

    const data = {
      post_id: postid,
      user_id: userid,
      comment: comment,
    };

    fetch('http://127.0.0.1:8000/api/createComment', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      },
      body: JSON.stringify(data),
    })
    .then(res => res.json())
    .then(data => {
      console.log(data);
      document.getElementById('message').value = '';
    })
    .catch(error => {
      console.error('Error in createComment fetch', error);
    });
  }

  // Fetch post details
  fetch(`http://127.0.0.1:8000/api/getpost/${postid}`, {
    method: 'GET',
    headers: {
      'Authorization': 'Bearer ' + localStorage.getItem('token')
    }
  })
  .then(res => res.json())
  .then(data => {
    console.log(data);
    document.getElementById('username').innerText = data.username;
    document.getElementById('content').innerText = data.content;
  })
  .catch(error => {
    console.error('Error in getpost fetch', error);
  });

  // Initialize Pusher
  const pusher = new Pusher('5d1c6340546a159c1ce3', { cluster: 'ap1' });
  const channel = pusher.subscribe('public' + postid);

  // Receive messages
  channel.bind('chat', function(data) {
    $.post("/receive", {
      _token: '{{csrf_token()}}',
      message: data.message,
    })
    .done(function(res) {
      $(".messages").append(res);
      $(document).scrollTop($(document).height());
    });
  });

  // Broadcast messages
  $("form").submit(function(event) {
    event.preventDefault();

    $.ajax({
      url: "/broadcast",
      method: 'POST',
      headers: {
        'X-Socket-Id': pusher.connection.socket_id
      },
      data: {
        _token: '{{csrf_token()}}',
        message: $("#message").val(),
        post_id: postid,
      }
    })
    .done(function(res) {
      $(".messages").append(res);
      $(document).scrollTop($(document).height());
      createComment();
      $("#message").val('');
    });
  });

  // Fetch current user details
  fetch('http://127.0.0.1:8000/api/getuser', {
    method: 'GET',
    headers: {
      'Authorization': 'Bearer ' + localStorage.getItem('token')
    }
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById('userkey').value = data.id;
  })
  .catch(error => {
    console.error('Error in getuser fetch', error);
  });

  // Fetch comments for the post
  fetch(`http://127.0.0.1:8000/api/getcomment/${postid}`, {
    method: 'GET',
    headers: {
      'Authorization': 'Bearer ' + localStorage.getItem('token')
    }
  })
  .then(res => res.json())
  .then(data => {
    console.log(data);
  })
  .catch(error => {
    console.error('Error in getcomment fetch', error);
  });
});
</script>

@endsection
