
<?php

class TaskController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $tasks = $this->model->getTasks();
        include 'views/main.php';
    }

    public function createTask() {
        // Обработка создания новой задачи
        $subject = $_POST['subject'];
        $type = $_POST['type'];
        $location = $_POST['location'];
        $datetime = $_POST['datetime'];
        $duration = $_POST['duration'];
        $comment = $_POST['comment'];

        $this->model->createTask($subject, $type, $location, $datetime, $duration, $comment);

        header('Location: index.php');
    }

    public function editTask() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $task = $this->model->getTaskById($id);
            if ($task) {
                include 'views/edit.php';
            } else {
                echo 'Задача не найдена.';
            }
        } else {
            echo 'Не указан идентификатор задачи.';
        }
    }

    public function updateTask() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $subject = $_POST['subject'];
            $type = $_POST['type'];
            $location = $_POST['location'];
            $datetime = $_POST['datetime'];
            $duration = $_POST['duration'];
            $comment = $_POST['comment'];

            $this->model->updateTask($id, $subject, $type, $location, $datetime, $duration, $comment);
            header('Location: index.php');
        } else {
            echo 'Не указан идентификатор задачи.';
        }
    }

    public function deleteTask() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->deleteTask($id);
            header('Location: index.php');
        } else {
            echo 'Не указан идентификатор задачи.';
        }
    }

    public function overdueTasks() {
        $tasks = $this->model->getOverdueTasks();
        include 'views/overdue.php';
    }

    public function completedTasks() {
        $tasks = $this->model->getCompletedTasks();
        include 'views/completed.php';
    }

    public function markTaskComplete() {
        $taskId = $_POST['taskId'];
        $taskComplete = isset($_POST['taskComplete']) ? true : false;

        if ($taskComplete) {
            $status = '1';
        } else {
            $status = '0';
        }

        $this->model->updateTaskStatus($taskId, $status);

        header('Location: index.php');
    }
}
