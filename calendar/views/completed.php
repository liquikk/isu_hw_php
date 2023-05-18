<!DOCTYPE html>
<html>
<head>
    <title>Выполненные задачи</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
    <div class="main">
    <a href="index.php" class="back">← Назад</a>
    <h1>Выполненные задачи</h1>
        <table>
    <tr>
        <th class="typ">Тип</th>
        <th class="zad">Задача</th>
        <th class="mes">Место</th>
        <th class="dat">Дата и время</th>
        <th class="dli">Длительность</th>
        <th class="com">Комментарий</th>
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
                    <a href="index.php?action=editTask&id=<?php echo $task['id']; ?>">Редактировать</a>
                    <a href="index.php?action=deleteTask&id=<?php echo $task['id']; ?>">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
</body>
</html>
