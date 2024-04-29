const loginFormElement = document.getElementById('loginFormElement');
        const loginButton = document.getElementById('button_click');

        button_click.addEventListener('click', function() {

            fetch('http://127.0.0.1:8000/api/login', {
                method: 'POST',
                // body: new FormData(loginFormElement),
                body: JSON.stringify(loginFormElement),
                // header: {}
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                const messageElement = document.getElementById('message');
                messageElement.textContent = data.message;
                messageElement.style.display = 'block'; 
                messageElement.style.textAlign = 'left'; 
                messageElement.style.color = data.message === 'Login Successfully' ? 'green' : 'red'; 

                if (data.message === 'Login Successfully') {
                    // Redirect to the dashboard
                    window.location.href = '/home';
                }
            })
            .catch(error => console.error('error', error));
        });