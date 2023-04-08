<?php
    $error = "";
    $db = mysqli_connect('localhost','root','','intership');

    if (isset($_POST['submit'])){
        $task = $_POST['task'];
        if(empty($task)){
            $error = "you must fill the task";
        }
        else{
            mysqli_query($db, "INSERT INTO `taskviewer` (Taskinfo) VALUES ('$task')");
            header('location:index.php');
        }
    }

    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM `taskviewer` WHERE TaskID=$id");
        header('location:index.php');
    }

    if(isset($_GET['update_task'])){
      $data1 = "<script>Confirm('Enter the data')</script>";

      $id1 = $_GET['update_task'];
      mysqli_query($db, "UPDATE FROM `taskviewer` WHERE TaskID=$id1");
      header('location:index.php');
  }

    $tasks = mysqli_query($db, "SELECT * FROM `taskviewer`;")
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <title>Task Viewer</title>
</head>

<body>

  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">TaskBar Hacker's</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">more info</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- navbar -->
  <form action="index.php" method="post">
    <?php if(isset($error)){?>
      <p> <?php echo $error;?> </p>
    <?php }?>

    <input type="text" name="task" class="task_input px-3 py-3">
    <button type="submit" class="add_btn" name="submit">Add Task</button>
  </form>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Task</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      
      <?php
          $i = 1;
          while($row = mysqli_fetch_array($tasks)){?>
      <tr>
        <!-- <td>?php echo $row['TaskID'];?></td> -->
        <td> <?php echo $i;?> </td>
        <td class="task"><?php echo $row['Taskinfo'];?> </td>
        <td class="delete"><a href="index.php?update_task=<?php echo $row['TaskID']; ?>">Update</a></td>
        <td class="delete"><a href="index.php?del_task=<?php echo $row['TaskID']; ?>">Delete</a></td>
      </tr>
      <?php $i++; } ?>

    </tbody>
  </table>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

    
</body>

</html>