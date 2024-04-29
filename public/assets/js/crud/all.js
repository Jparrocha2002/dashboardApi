fetch('http://localhost/dashboardActivity/back_end/route/all.php')
.then(res => res.json())
.then(data => {
    console.log(data);

    const tablebody = document.getElementById('tablebody'); 

    tablebody.innerHTML = '';

    for(let i = 0; i < data.length; i++)
    {
        const body = `<td>${data[i].id}</td>        
                      <td>${data[i].first_name}</td>        
                      <td>${data[i].last_name}</td>        
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
.catch(error => console.error('error', error));