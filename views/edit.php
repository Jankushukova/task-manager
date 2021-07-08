<?php
session_start();
if (!$_SESSION['online']){
    header("Location:/?error=unauthorized");
}
if(isset($_REQUEST['task'])){
    $task = $_REQUEST['task'];
}
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
            <form action="save" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" value="<?php echo $task['username'] ?>" class="form-control" id="username" placeholder="Enter username">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" value="<?php echo $task['email'] ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="description">Task</label>
                                    <input type="text" name="description" value="<?php echo $task['description'] ?>" class="form-control" id="description" placeholder="Enter task">
                                    <input type="hidden" name="id" value="<?php echo $task['id'] ?>" class="form-control" >
                                </div>

                                <div class="form-check">
                                    <input name="status" value="1" class="form-check-input" type="checkbox" <?php echo ($task['status']) == 1 ? 'checked' : '' ?> id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Done
                                    </label>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Update Task</button>

                                </div>
                            </form>



        </div>
    </div>


</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>