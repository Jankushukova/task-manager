<?php

	$tasks = $_REQUEST['task_list']->data;
	$count = $_REQUEST['task_list']->count;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$sort = isset($_GET['sortBy']) ? $_GET['sortBy'] : '';
	$error = isset($_GET['error']) ? $_GET['error'] : null;
	$message = isset($_GET['message']) ? $_GET['message'] : null;
?>
<!DOCTYPE html>
	<html>
	<head>
		<title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/42dc4cfebc.js" crossorigin="anonymous"></script>

    </head>
	<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Task Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" data-toggle="modal" data-target="#loginModal">Login </a>
                </li>
            </ul>

        </div>
    </nav>
    <div class="container">
        <div class="card  border-0">

            <div class="card-body">
                <?php if ($error) {
                    echo " <div class='alert alert-danger' role='alert'>$error</div>";

                }?>
                <?php if ($message) {
                    echo " <div class='alert alert-success' role='alert'>$message</div>";

                }?>

                <div class="text-right p-2">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                    Create a task
                </button>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"><a href="/">#</a></th>
                        <th scope="col">
                            <a href="/?sortBy=username&order=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="/?sortBy=username&order=desc"><i class="fas fa-arrow-down"></i></a>
                            username</th>
                        <th scope="col">
                            <a href="/?sortBy=email&order=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="/?sortBy=email&order=desc"><i class="fas fa-arrow-down"></i></a>

                            email</th>
                        <th scope="col">
                            <a href="/?sortBy=description&order=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="/?sortBy=description&order=desc"><i class="fas fa-arrow-down"></i></a>

                            task</th>
                        <th scope="col">
                            <a href="/?sortBy=status&order=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="/?sortBy=status&order=desc"><i class="fas fa-arrow-down"></i></a>

                            status</th>
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
                </tr>";

                        }
                    }

                    ?>


                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?php echo ($page ==1) ? 'disabled':'' ?> "><a class="page-link " href="?page=<?php echo ($page > 1) ? $page - 1 : 1?>&sort=<?php echo $sort?>" >Previous</a></li>
                       <?php
                       for($i = 1; $i <= $count; $i++){
                           echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "&sort=" . $sort . "'> $i</a></li>";

                       }
                       ?>
                        <li class="page-item  <?php echo ($page == $count) ? 'disabled':'' ?>"><a class="page-link" href="?page=<?php echo ($page < $count) ? $page + 1 : $count?>&sort=<?php echo $sort?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>


    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="description">Task</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Enter task">
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-success">ADD Task</button>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="login" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                        </div>


                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Login</button>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>