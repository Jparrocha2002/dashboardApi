const registerFormElement = document.getElementById('registerFormElement');

registerFormElement.addEventListener('submit', function(event){
    event.preventDefault();

    fetch('http://localhost/dashboardActivity/back_end/route/register.php', {
        method: 'POST',
        body: new FormData(registerFormElement),
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        const messageElement = document.getElementById('message');
        messageElement.textContent = data.message;
        messageElement.style.display = 'block';
        messageElement.style.textAlign = 'left'; 
        messageElement.style.color = data.message === 'Registered Successfully' ? 'green' : 'red';

        if(data.message === 'Registered Successfully')
        {
            window.location.href = 'login.html';
        }
    })
    .catch(error => console.error('error', error));
});