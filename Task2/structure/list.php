<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <style>
        table {
            width: 60%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        #noteForm, #editForm {
            display: none;
            margin-top: 15px;
        }
        input, textarea {
            display: block;
            width: 50%;
            margin: 5px 0;
            padding: 3px;
        }
    </style>
</head>
<body>

<h2>Мої нотатки</h2>
<button id="getNotes">Завантажити нотатки</button>
<button id="createNote">Створити нотатку</button>

<div id="noteForm">
    <h3>Створити нотатку</h3>
    <input type="text" id="noteTitle" placeholder="Заголовок" required>
    <textarea id="noteContent" placeholder="Текст" required></textarea>
    <button id="saveNote">Зберегти</button>
</div>

<div id="editForm">
    <h3>Редагувати нотатку</h3>
    <input type="text" id="editTitle" placeholder="Заголовок" required>
    <textarea id="editContent" placeholder="Текст" required></textarea>
    <input type="hidden" id="editID">
    <button id="updateNote">Оновити</button>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Текст</th>
            <th>Функції</th>
        </tr>
    </thead>
    <tbody id="notes"></tbody>
</table>

<a href="../index.php">Назад</a>

<script>
document.querySelector("#getNotes").addEventListener("click", async function() 
{
    let response = await fetch("getList.php");
    let notes = await response.json();
    
    let tabler = document.querySelector("#notes");
    tabler.innerHTML = "";

    if (notes.error) 
    {
        alert(notes.error);
        return;
    }

    notes.forEach(note => 
    {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td>${note.ID}</td>
            <td>${note.Title}</td>
            <td>${note.Content.replace(/\n/g, "<br>")}</td>
            <td>
                <button class="editor" data-id="${note.ID}">Редагувати</button>
                <button class="delete" data-id="${note.ID}">Видалити</button>
            </td>
        `;
        tabler.appendChild(row);
    });
});

document.querySelector("#notes").addEventListener("click", async function(event) 
{
    if (event.target && event.target.classList.contains("editor")) 
    {
        let id = event.target.getAttribute("data-id");

        let response = await fetch("getNoteById.php?id=" + id);
        let note = await response.json();

        if (note.error) 
        {
            alert(note.error);
            return;
        }

        document.querySelector("#editID").value = id;
        document.querySelector("#editTitle").value = note.Title;
        document.querySelector("#editContent").value = note.Content;

        document.querySelector("#editForm").style.display = "block";
    }

    if (event.target && event.target.classList.contains("delete")) 
    {
        let id = event.target.getAttribute("data-id");

        if (confirm("Ви впевнені, що хочете видалити цю нотатку?")) 
        {
            let response = await fetch("deleteNote.php", 
            {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id })
            });
            let result = await response.json();
            document.querySelector("#getNotes").click();

        }
    }
});

document.querySelector("#createNote").addEventListener("click", function() 
{
    document.querySelector("#noteForm").style.display = "block";
});

document.querySelector("#saveNote").addEventListener("click", async function() 
{
    let title = document.querySelector("#noteTitle").value.trim();
    let content = document.querySelector("#noteContent").value.trim();

    if (!title || !content) 
    {
        alert("Введіть інформацію!");
        return;
    }

    let response = await fetch("create.php", 
    {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ title, content })
    });

    let result = await response.json();

    if (result.success) 
    {
        document.querySelector("#noteTitle").value = "";
        document.querySelector("#noteContent").value = "";
        document.querySelector("#noteForm").style.display = "none";
        document.querySelector("#getNotes").click();
    }
});

document.querySelector("#updateNote").addEventListener("click", async function() 
{
    let id = document.querySelector("#editID").value;
    let title = document.querySelector("#editTitle").value.trim();
    let content = document.querySelector("#editContent").value.trim();

    if (!title || !content) 
    {
        alert("Введіть інформацію для редагування!");
        return;
    }

    let response = await fetch("updateNote.php", 
    {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id, title, content })
    });

    let result = await response.json();

    if (result.success) 
    {
        document.querySelector("#editForm").style.display = "none";
        document.querySelector("#getNotes").click();
    }
});
</script>

</body>
</html>
