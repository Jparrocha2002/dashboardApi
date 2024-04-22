const loginFormElement = document.getElementById('loginFormElement');

        loginFormElement.addEventListener('submit', function(event){
            event.preventDefault();

            fetch('http://localhost/dashboardActivity/back_end/route/login.php', {
                method: 'POST',
                body: new FormData(loginFormElement),
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                const messageElement = document.getElementById('message');
                messageElement.textContent = data.message;
                messageElement.style.display = 'block'; 
                messageElement.style.textAlign = 'left'; 
                messageElement.style.color = data.message === 'login successful' ? 'green' : 'red'; 

                if(data.message === 'login successful') 
                {
                    window.location.href = 'dashboard.php';
                }
            })
            .catch(error => console.error('error', error));
        });