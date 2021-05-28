<?php

namespace App\Models;

class Task extends Modal
{
    private $table = 'tasks';

    public function get($type = '*')
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id ASC";

        if ($type == 'completed' || $type == 'active') {
            $sql = "SELECT * FROM {$this->table} WHERE status='$type'  ORDER BY id ASC";
        }

        if ($query = $this->connection->query($sql)) {
            $results = $query->fetch_all(MYSQLI_ASSOC);

            return $results;
        }

        return FALSE;
    }

    public function insert($name)
    {
        $sql = "INSERT INTO {$this->table} (name) VALUES ('$name')";

        if ($this->connection->query($sql) === TRUE) return TRUE;

        return FALSE;
    }

    public function update($id, $name)
    {
        $sql = "UPDATE {$this->table} SET name='$name' WHERE id=$id";

        if ($this->connection->query($sql) === TRUE) return TRUE;
        return FALSE;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id='$id'";

        if ($this->connection->query($sql) === TRUE) return TRUE;
        return FALSE;
    }

    public function deleteCompletedList()
    {
        $sql = "DELETE FROM {$this->table} WHERE status='completed'";

        if ($this->connection->query($sql) === TRUE) return TRUE;
        return FALSE;
    }

    public function changeStatus($id, $status)
    {
        $sql = "UPDATE {$this->table} SET status='$status' WHERE id=$id";

        if ($this->connection->query($sql) === TRUE) return TRUE;
        return FALSE;
    }

    public function countTasksByStatus($status)
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE status='$status'";

        if ($query = $this->connection->query($sql)) {
            if ($row = $query->fetch_array(MYSQLI_ASSOC)) return $row['total'];
        }

        return 0;
    }
}
