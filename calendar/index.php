
<?php

require_once 'models/Task.php';
require_once 'controllers/TaskController.php';

// Подключение к базе данных
$db = new mysqli('localhost', 'makar', '123', 'calendar');

// Создание экземпляра модели
$model = new Task($db);

// Создание экземпляра контроллера
$controller = new TaskController($model);

// Определение действий на основе запроса
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Обработка запроса
switch ($action) {
    case 'createTask':
        $controller->createTask();
        break;
    case 'editTask':
        $controller->editTask();
        break;
    case 'updateTask':
        $controller->updateTask();
        break;
    case 'deleteTask':
        $controller->deleteTask();
        break;
    case 'completedTasks':
        $controller->completedTasks();
        break;
    case 'markTaskComplete':
        $controller->markTaskComplete();
        break;
    case 'overdueTasks':
        $controller->overdueTasks();
        break;
    default:
        $controller->index();
        break;
}
?>
