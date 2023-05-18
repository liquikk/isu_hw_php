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
    <div class="header-links">
    <a href="index.php?action=overdueTasks">Просмотреть просроченные задачи</a>
    <a href="index.php?action=completedTasks">Просмотреть выполненные задачи</a>
    </div>
    </div>
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

        <label for="duration">Длительность:</label>
        <input type="number" id="duration" name="duration"><br>

        <label for="comment">Комментарий:</label>
        <textarea id="comment" name="comment"></textarea><br>

        <input type="submit" value="Создать">
    </form>
    <h2>Текущие задачи</h2>
    <table>
    <tr>
        <th class="typ">Тип</th>
        <th class="zad">Задача</th>
        <th class="mes">Место</th>
        <th class="dat">Дата и время</th>
        <th class="dli">Длительность</th>
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
                <a href="index.php?action=editTask&id=<?php echo $task['id']; ?>">Редактировать</a>
                <a href="index.php?action=deleteTask&id=<?php echo $task['id']; ?>">Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>

</body>
</html>