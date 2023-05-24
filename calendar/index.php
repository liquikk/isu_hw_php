
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
    case 'markTaskComplete':
        $controller->markTaskComplete();
        break;
    case 'todayTasks':
        $controller->showTodayTasks();
        break;
    case 'tomorrowTasks':
        $controller->showTomorrowTasks();
        break;
    case 'currentWeekTasks':
    $controller->showCurrentWeekTasks();
    break;
    case 'nextWeekTasks':
        $controller->showNextWeekTasks();
        break;
    case 'searchTasks':
        $controller->searchTasks($_GET['date']);
        break;
    case 'filterTasks':
        $controller->filterTasks($_GET['filter']);
        break;
    default:
        $controller->index();
        break;
}
?>
