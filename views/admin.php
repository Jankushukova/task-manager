<?php
session_start();
if (!$_SESSION['online']){
    header("Location:/index?error=unauthorized");
}
$tasks = $_REQUEST['task_list']->data;
$count = $_REQUEST['task_list']->count;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$message = isset($_GET['message']) ? $_GET['message'] : null;

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/dashboard">Task Manager Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/logout">Logout </a>
            </li>
        </ul>

    </div>
</nav>
<div class="container">
    <div class="card  border-0">
        <div class="card-body">
            <?php if ($message) {
                echo " <div class='alert alert-success' role='alert'>$message</div>";

            }?>


            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                    <th scope="col">task</th>
                    <th scope="col">status</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                if($tasks!=null){
                    foreach($tasks as $task){

                        echo " 
                <tr>
                <th scope='row'>".$task['id']. "</th>
                <td>".$task['username']. "</td>
                <td>".$task['email']. "</td>
                <td>".$task['description']. "</td>
                <td>".(($task['status']==1)? 'Done' : 'Processing'). "</td>
                <td><a href='/edit?id=" . $task['id'] . "' class='btn btn-warning' >Edit</a></td>
                </tr>";

                    }
                }

                ?>


                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo ($page ==1) ? 'disabled':'' ?> "><a class="page-link " href="?page=<?php echo ($page > 1) ? $page - 1 : 1?>" >Previous</a></li>
                    <?php
                    for($i = 1; $i <= $count; $i++){
                        echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'> $i</a></li>";

                    }
                    ?>
                    <li class="page-item  <?php echo ($page == $count) ? 'disabled':'' ?>"><a class="page-link" href="?page=<?php echo ($page < $count) ? $page + 1 : $count?>">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>


</div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>