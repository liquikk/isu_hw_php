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
            $page = $_SERVER['HTTP_REFERER'];
            header("Location: $page");
        } else {
            echo 'Не указан идентификатор задачи.';
        }
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

        $page = $_SERVER['HTTP_REFERER'];

        header("Location: $page");

    }

    public function showTodayTasks() {
        $tasks = $this->model->getTasksByDate(date('Y-m-d'));
        include 'views/main.php';
    }

    public function showTomorrowTasks() {
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $tasks = $this->model->getTasksByDate($tomorrow);
        include 'views/main.php';
    }
    public function showCurrentWeekTasks() {
        $tasks = $this->model->getTasksForCurrentWeek();
        include 'views/main.php';
    }
    
    public function showNextWeekTasks() {
        $tasks = $this->model->getTasksForNextWeek();
        include 'views/main.php';
    }
    public function searchTasks($date) {
        $tasks = $this->model->getTasksByDate($date);
        include 'views/main.php';
    }
    public function filterTasks($filter) {
        switch ($filter) {
            case 'current':
                $tasks = $this->model->getCurrentTasks();
                break;
            case 'overdue':
                $tasks = $this->model->getOverdueTasks();
                break;
            case 'completed':
                $tasks = $this->model->getCompletedTasks();
                break;
            default:
                $tasks = $this->model->getTasks();
                break;
        }
        include 'views/main.php';
    }
    
}
