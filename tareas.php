<?php
$host = 'localhost';
$db = 'tareas_db';
$user = 'root';
$pass = '';

// Conectar a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Agregar una nueva tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task')";
    if ($conn->query($sql) === TRUE) {
        echo "Nueva tarea añadida con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todas las tareas
$result = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas</title>
</head>
<body>
    <h1> Tareapp<br>Tu gestor de tareas </h1>
    <p> Ingrese aquí las tareas: </p>
    <form action="tareas.php" method="POST">
        <input type="text" name="task" placeholder="Añadir nueva tarea">
        <button type="submit">Añadir</button>
    </form>
    <ul>
        <?php while($row = $result->fetch_assoc()): ?>
            <li><?php echo htmlspecialchars($row['task']); ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
