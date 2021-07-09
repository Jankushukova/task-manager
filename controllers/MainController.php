<?php
	
	namespace Controllers;

	use Core\Controller;
    use Models\Task;

    class MainController extends Controller{

		function index(){

		    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            $sort_by = (isset($_GET['sortBy'])) ? $_GET['sortBy'] : null;
            $sort_order = (isset($_GET['order'])) ? $_GET['order'] : null;
            $tasks = Task::getAll($page, $sort_by, $sort_order);
            $_REQUEST['task_list'] = $tasks;

			require_once "../views/index.php";
		}

		function add(){
            $location = "/?error=404 Bad Request";

		    if (isset($_POST['username']) && $_POST['email'] && $_POST['description']){
                $task['username'] = $_POST['username'];
                $task['email'] = $_POST['email'];
                $task['description'] = $_POST['description'];

                Task::insert($task);
                $location = "/";
		    }


			header("Location:$location?message=Record Successfully added");

		}

		function edit(){

			$task = Task::find($_GET['id']);
			$_REQUEST['car'] = $task;

			require_once "../views/edit.php";

		}


		function save(){
            $location = "/dashboard?error=404 Bad Request";
            if (isset($_POST['id']) &&
                isset($_POST['username']) &&
                isset($_POST['email']) &&
                isset($_POST['description']))
            {
                $task['id'] = $_POST['id'];
                $task['username'] = $_POST['username'];
                $task['email'] = $_POST['email'];
                $task['status'] = isset($_POST['status']) ? '1' : '0';
                $task['description'] = $_POST['description'];
                $task['edited'] = $this->handleTextChanges($_POST['id'], $_POST['description']) ? 1 : 0;
                Task::update($task);
                $location = "/dashboard?message=Record Successfully updated";
            }

            header("Location:$location");
		}

		function dashboard(){
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            $tasks = Task::getAll($page);
            $_REQUEST['task_list'] = $tasks;
            require_once "../views/admin.php";
        }

		function login(){
		    $location = "/?error=invalid credentials";
            session_start();
            if ($_POST['username'] == 'admin' && $_POST['password'] == 123) {
                $_SESSION['online'] = true;
                $location = "dashboard";
            }
            header("Location:$location");
        }

        function logout(){
		    session_start();
            unset($_SESSION['online']);
            header("Location:/");
        }
        function handleTextChanges($id, $text){
            $task = Task::find($id);
            print_r($task);
            return ($task['description']!=$text) || ($task['edited']==1);

        }
	}

?>