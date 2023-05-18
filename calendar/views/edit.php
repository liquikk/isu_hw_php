<!DOCTYPE html>
<html>
<head>
    <title>Редактировать задачу</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
<div class="main_edit">
<a href="index.php" class="back">← Назад</a>
    <h1>Редактировать задачу</h1>

    <form action="index.php?action=updateTask" method="post" class="edit_form">
        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">

        <label for="subject">Тема:</label>
        <input type="text" id="subject" name="subject" value="<?php echo $task['subject']; ?>" required><br>

        <label for="type">Тип:</label>
        <select id="type" name="type">
            <option value="Встреча" <?php if ($task['type'] === 'Встреча') echo 'selected'; ?>>Встреча</option>
            <option value="Звонок" <?php if ($task['type'] === 'Звонок') echo 'selected'; ?>>Звонок</option>
            <option value="Совещание" <?php if ($task['type'] === 'Совещание') echo 'selected'; ?>>Совещание</option>
            <option value="Дело" <?php if ($task['type'] === 'Дело') echo 'selected'; ?>>Дело</option>
        </select><br>

        <label for="location">Место:</label>
        <input type="text" id="location" name="location" value="<?php echo $task['location']; ?>"><br>

        <label for="datetime">Дата и время:</label>
        <input type="datetime-local" id="datetime" name="datetime" value="<?php echo $task['datetime']; ?>" required><br>

        <label for="duration">Длительность:</label>
        <input type="number" id="duration" name="duration" value="<?php echo $task['duration']; ?>"><br>

        <label for="comment">Комментарий:</label>
        <textarea id="comment" name="comment"><?php echo $task['comment']; ?></textarea><br>

        <input type="submit" value="Сохранить">
    </form>
</div>
</body>
</html>
