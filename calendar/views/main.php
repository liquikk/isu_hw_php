<!DOCTYPE html>
<html>
<head>
    <title>Мой календарь</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
    <div class="main">
    <div class="header">
    <h1>Мой календарь</h1>
    <h2>Создать задачу</h2>
    <form action="index.php?action=createTask" method="post" class="create">
        <label for="subject">Тема:</label>
        <input type="text" id="subject" name="subject" required><br>
        
        <label for="type">Тип:</label>
        <select id="type" name="type">
            <option value="Встреча">Встреча</option>
            <option value="Звонок">Звонок</option>
            <option value="Совещание">Совещание</option>
            <option value="Дело">Дело</option>
        </select><br>

        <label for="location">Место:</label>
        <input type="text" id="location" name="location"><br>

        <label for="datetime">Дата и время:</label>
        <input type="datetime-local" id="datetime" name="datetime" required><br>

        <label for="duration">Длительность (в минутах):</label>
        <input type="number" id="duration" name="duration"><br>

        <label for="comment">Комментарий:</label>
        <textarea id="comment" name="comment"></textarea><br>

        <input type="submit" value="Создать">
    </form>
    <h2>
    <?php
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $date = isset($_GET['date']) ? $_GET['date'] : '';

    switch ($action) {
        case 'todayTasks':
            echo 'Задачи на сегодня';
            break;
        case 'tomorrowTasks':
            echo 'Задачи на завтра';
            break;
        case 'currentWeekTasks':
            echo 'Задачи на эту неделю';
            break;
        case 'nextWeekTasks':
            echo 'Задачи на следующуй неделю';
            break;
        case 'searchTasks':
            echo 'Задачи на ' . $date;
            break;
        default:
            switch ($filter) {
                case 'all':
                    echo 'Все задачи';
                    break;
                case 'current':
                    echo 'Текущие задачи';
                    break;
                case 'overdue':
                    echo 'Просроченные задачи';
                    break;
                case 'completed':
                    echo 'Выполненные задачи';
                    break;
                default:
                    echo 'Все задачи';
                    break;
            }
            break;
    }
    ?>
    </h2>
<div class='fifa'>
<form method="GET" action="index.php">
    <select id="task-filter" name="filter">
        <option value="">Выберите список</option>
        <option value="all">Все задачи</option>
        <option value="current">Текущие</option>
        <option value="overdue">Просроченные</option>
        <option value="completed">Выполненные</option>
    </select>
    <input type="hidden" name="action" value="filterTasks">
    </form>
    <form method="GET" action="index.php">
        <input type="date" id="search-date" name="date" required>
        <input class='btn_search' type="submit" value="Искать">
        <input type="hidden" name="action" value="searchTasks">
    </form>
    <div class="choice">
        <a href="index.php?action=todayTasks">Сегодня</a>
        <a href="index.php?action=tomorrowTasks">Завтра</a>
        <a href="index.php?action=currentWeekTasks">На этой неделе</a>
        <a href="index.php?action=nextWeekTasks">На след. неделе</a>
    </div>
</div>
    <table>
    <tr>
        <th class="typ">Тип</th>
        <th class="zad">Задача</th>
        <th class="mes">Место</th>
        <th class="dat">Дата и время</th>
        <th class="dli">Длительность, мин.</th>
        <th class="com">Комментарий</th>
        <th class="sta">Статус</th>
        <th class="dei">Действия</th>
    </tr>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?php echo $task['type']; ?></td>
            <td><?php echo $task['subject']; ?></td>
            <td><?php echo $task['location']; ?></td>
            <td><?php echo $task['datetime']; ?></td>
            <td><?php echo $task['duration']; ?></td>
            <td><?php echo $task['comment']; ?></td>
            <td>
                <form method="POST" action="index.php?action=markTaskComplete">
                    <input type="hidden" name="taskId" value="<?php echo $task['id']; ?>">
                    <input type="checkbox" name="taskComplete" <?php echo ($task['status'] === '1') ? 'checked' : ''; ?> onchange="this.form.submit()">
                </form>
            </td>
            <td>
                <a class='act' href="index.php?action=editTask&id=<?php echo $task['id']; ?>">Редактировать</a>
                <a class='act' href="index.php?action=deleteTask&id=<?php echo $task['id']; ?>">Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
<script>
    document.getElementById('task-filter').addEventListener('change', function() {
        this.form.submit();
    });
</script>
</body>
</html>