const createForm = document.getElementById('createForm');

createForm.addEventListener('submit', function(event){
    event.preventDefault();

    fetch('http://localhost/dashboardActivity/back_end/route/register.php', {
        method: 'POST',
        body: new FormData(createForm),
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        alert(data.message);
        if(data.message === 'Registered Successfully')
        {
            window.location.href = 'post.php';
        }
    })
    .catch(error => console.error('error', error));
});