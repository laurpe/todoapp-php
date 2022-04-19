<?php include 'db.php'; ?>
<?php

if (isset($_GET["delete_id"])) {
    $id = $_GET["delete_id"];
    $query = "DELETE FROM todos WHERE id = $id";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Delete query failed" . mysqli_error($conn));
    }
    header('location: main.php');
}

//Create todo
if (isset($_POST['submit'])) {
    $todo = $_POST["todo"];

    if (!$todo) {
        echo "Todo cannot be empty";
      }

      $todo = mysqli_real_escape_string($conn, $todo);

      // Create the records inside db
  $query = "INSERT INTO todos(name)";
  $query .= "VALUES ('$todo')";

  $result = mysqli_query($conn, $query);

  if (!$result) {
    die('Query insertion failed');
  }
}
//Get todos from database
$query = "SELECT * FROM todos";
$todos = mysqli_query($conn, $query);
if (!$todos) {
  die('Reading db records failed');
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $updated_todo = $_POST['update_todo'];

    mysqli_query($conn, "UPDATE todos SET name='$updated_todo' WHERE id=$id");

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Update query failed" . mysqli_error($conn));
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add todo</h1>
    <form action="main.php" method="post">
        <input type="text" name="update_todo" placeholder="Write your updated todo text here" />
        <select name="id" id="">
        <?php
            while ($row = mysqli_fetch_assoc($todos)) {
                $id = $row['id'];
                echo "<option value='$id'>$id</option>";
            }
        ?>
        </select>
        <input type="submit" name="update" value="update todo">
    </form>
    <form action="main.php" method="post" >
        <input type="text" name="todo" placeholder="Write your todo here" />
        <input type="submit" name="submit" value="add todo" />
    </form>
    
    <?php
        while ($row = mysqli_fetch_assoc($todos)) {
    ?>
    <div><?php echo $row["id"]; echo $row["name"] ?><a href="main.php?delete_id=<?php echo $row["id"]?>">delete</a></div>
<?php }
    ?>
</body>
</html>
