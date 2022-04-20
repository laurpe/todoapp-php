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

//Update todo
if (isset($_POST['submit_update'])) {
    $id = $_POST['update_id'];
    $updated_todo = $_POST["updated_todo"];

    mysqli_query($conn, "UPDATE todos SET name='$updated_todo' WHERE id=$id");

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Update query failed" . mysqli_error($conn));
    }

    header('location: main.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
    <h1>Add todo</h1>
    
    <form action="main.php" method="post" >
        <input class="todo-input" type="text" name="todo" placeholder="Write your todo here" />
        <input type="submit" name="submit" value="add todo" />
    </form>
    </header>
    <div class="todo-container">
    <?php
    
        while ($row = mysqli_fetch_assoc($todos)) {
    ?>
    
    <div class="todo">
       <span> <?php  echo $row["name"] ?></span><a href="main.php?delete_id=<?php echo $row["id"]?>">X</a>
       <div class="edit-container">
        <button type="button" class="editBtn">edit</button> 
                <form class="edit-form" method="post" action="main.php"> 
                    <input type="text" name="update_id" value="<?php echo $row["id"] ?>" hidden />
                    <input type="text" name="updated_todo" />
                    <input type="submit" name="submit_update" value="update" />
                </form></div>
    </div>
    
<?php } 
    ?> </div>
    <script type="text/javascript" src="main.js"></script>
</body>
</html>