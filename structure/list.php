<?php
session_start();
if (!isset($_SESSION['user'])) 
{
    header("Location: ../index.php");
    exit();
}

require "../DB/db.php";

$myid_req = $pdo->prepare("SELECT ID FROM users WHERE Login = ?");
$myid_req->execute([$_SESSION['user']]);
$myid = $myid_req->fetchColumn();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список користувачів</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        form {
            margin-top: 15px;
        }
        button {
            margin-top: 10px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<h2>Список користувачів</h2>
<button id="getUsers">Завантажити користувачів</button>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Прізвище</th>
            <th>Логін</th>
        </tr>
    </thead>
    <tbody id="users"></tbody>
</table>

<?php if ($_SESSION['user']) : ?>
    <div id="actions">
        <button id="editProfile">Редагувати інформацію</button>
        <button id="deleteProfile">Видалити профіль</button>
        </div>
<?php endif; ?>

<script>
document.querySelector("#getUsers").addEventListener("click", async function() 
{
    let response = await fetch("getList.php");
    let users = await response.json();
    
    let tabler = document.querySelector("#users");
    tabler.innerHTML = "";

    users.forEach(user => 
    {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td>${user.ID}</td>
            <td>${user.Name}</td>
            <td>${user.Lastname}</td>
            <td>${user.Login}</td>
        `;
        tabler.appendChild(row);
    });
});

document.getElementById('editProfile').addEventListener('click', function() 
{
    window.location.href = `edit.php?id=<?=$myid?>`;
});
document.getElementById("deleteProfile").addEventListener("click", async function() {
    if (!confirm("Ви впевнені, що хочете видалити профіль?")) return;

    let response = await fetch("delete.php", 
    {
        method: "POST",
        headers: { "Content-Type": "application/json" }
    });

    let result = await response.json();

    if (result.success) 
    {
        alert(result.message);
        window.location.href = "../index.php";
    } 
    else 
    {
        alert(result.message || "Помилка видалення");
    }
});
</script>

<a href="../index.php">Назад</a>
</body>
</html>
