INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(1, 1, "2024-02-21", "2024-03-21");
INSERT INTO users_books (users_id, books_id, checkout_date) 
    VALUES(2, 2, "2024-05-24");
INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(3, 3, "2024-05-20", "2024-06-21");
INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(4, 4, "2024-03-05", "2024-04-06");
INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(5, 5, "2024-05-19", "2024-05-24");
INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(1, 12, "2024-04-12", "2024-05-24");
INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(6, 10, "2024-03-24", "2024-04-25");
INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(7, 6, "2024-04-23", "2024-05-24");
INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(8, 7, "2024-04-24", "2024-05-24");
INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(9, 8, "2024-05-15", "2024-05-22");
INSERT INTO users_books (users_id, books_id, checkout_date) 
    VALUES(10, 9, "2024-05-24");
INSERT INTO users_books (users_id, books_id, checkout_date) 
    VALUES(1, 11, "2024-05-24");
INSERT INTO users_books (users_id, books_id, checkout_date, return_date) 
    VALUES(1, 3, "2024-05-30", "2024-06-5");
INSERT INTO users_books (users_id, books_id, checkout_date) 
    VALUES(10, 1, "2024-05-30", "2024-06-5");
INSERT INTO users_books (users_id, books_id, checkout_date) 

INSERT INTO users_books (users_id, books_id, checkout_date) 

INSERT INTO users_books (users_id, books_id, checkout_date) 

INSERT INTO users_books (users_id, books_id, checkout_date) 



-- <thead class="table-light">
--     <tr>
--         <th>nombre usuario</th>

--         <th>Titulo del libro</th>
--         <th>Fechas</th>
--     </tr>
-- </thead>
-- <tbody>
--     <tr>
--         <td id="username"></td>
--         <td id="title"></td>
--         <td id="checkout_date"></td>
--     </tr> 
--  </tbody>


console.log(id);
document.getElementById('prestamos').style.display = 'block';
axios.get('/libros/'+id)
.then(response => {
        jsonString = JSON.parse(response.data);
        console.log(jsonString);
        document.getElementById('username').textContent = jsonString.username;
        document.getElementById('title').textContent = jsonString.title;
        
        document.getElementById('checkout_date').textContent = new Date(jsonString.checkout_date.date).toLocaleDateString();
    })
    .catch(error => console.error('Error:', error));

    
        if (id.some(item => item !== null && item !== undefined)) {
                const ul = document.createElement('ul');

                id.forEach(item => {
                    if (item !== null && item !== undefined) {
                        const li = document.createElement('li');
                        li.textContent = item;
                        ul.appendChild(li);
                    }
                });

                listaElementos.appendChild(ul);
            } else {
                listaElementos.textContent = 'No hay registros.';
        }
        

        const table = document.getElementById('tablaRegistros').getElementsByTagName('tbody')[0];

        const newRow = table.insertRow();

        const usernameCell = newRow.insertCell(0);
        const titleCell = newRow.insertCell(1);
        const checkout_dateCell = newRow.insertCell(2);
        const return_dateCell = newRow.insertCell(3);

        usernameCell.innerHTML = username;
        titleCell.innerHTML = title;
        checkout_dateCell.innerHTML = checkout_date;
        return_dateCell.innerHTML = return_date;