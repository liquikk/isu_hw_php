<?php

class Task {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createTask($subject, $type, $location, $datetime, $duration, $comment) {
        $query = "INSERT INTO tasks (subject, type, location, datetime, duration, comment) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssis", $subject, $type, $location, $datetime, $duration, $comment);
        $stmt->execute();
        $stmt->close();
    }

    public function getTasks() {
        $query = "SELECT * FROM tasks ORDER BY datetime";
        $result = $this->db->query($query);
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        $result->close();
        return $tasks;
    }

    public function getTaskById($id) {
        $query = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $task = $result->fetch_assoc();
        $stmt->close();
        return $task;
    }

    public function updateTask($id, $subject, $type, $location, $datetime, $duration, $comment) {
        $query = "UPDATE tasks SET subject = ?, type = ?, location = ?, datetime = ?, duration = ?, comment = ? 
                  WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssisi", $subject, $type, $location, $datetime, $duration, $comment, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteTask($id) {
        $query = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getOverdueTasks() {
        $currentDateTime = date('Y-m-d H:i:s');
        $query = "SELECT * FROM tasks WHERE datetime < ? and status = 0  ORDER BY datetime";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $currentDateTime);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        $stmt->close();
        return $tasks;
    }


    public function getCompletedTasks() {
        $query = "SELECT * FROM tasks WHERE status = '1'  ORDER BY datetime";
        $result = $this->db->query($query);
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        $result->close();
        return $tasks;
    }

    public function updateTaskStatus($taskId, $status) {
        echo "taskId: $taskId, status: $status";
        $query = "UPDATE tasks SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $status, $taskId);
        $stmt->execute();
        $stmt->close();
    }
    
    public function getTasksByDate($date) {
        $query = "SELECT * FROM tasks WHERE DATE(datetime) = ? and status = 0  ORDER BY datetime";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        $stmt->close();
        return $tasks;
    }

    public function getTasksForCurrentWeek() {
        $startOfWeek = date('Y-m-d', strtotime('this week'));
        $endOfWeek = date('Y-m-d', strtotime('this week +6 days'));
    
        $query = "SELECT * FROM tasks WHERE DATE(datetime) BETWEEN ? AND ? AND status = 0 ORDER BY datetime";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $startOfWeek, $endOfWeek);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        $stmt->close();
        return $tasks;
    }
    
    public function getTasksForNextWeek() {
        $startOfWeek = date('Y-m-d', strtotime('next week'));
        $endOfWeek = date('Y-m-d', strtotime('next week +6 days'));
    
        $query = "SELECT * FROM tasks WHERE DATE(datetime) BETWEEN ? AND ? AND status = 0  ORDER BY datetime";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $startOfWeek, $endOfWeek);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        $stmt->close();
        return $tasks;
    }

    public function getCurrentTasks() {
        $currentDateTime = date('Y-m-d H:i:s');
        $query = "SELECT * FROM tasks WHERE datetime >= ? AND status = 0  ORDER BY datetime";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $currentDateTime);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        $stmt->close();
        return $tasks;
    }

}
?>