<?php

namespace App;

use App\Models\Task;

class ToDoController
{
    public function handle()
    {
        $task = new Task;
        $response = [
            'status' => 'success',
            'message' => 'Successfully done yor job',
        ];

        $type = $_POST['type'];
        $value = $_POST['value'];
        $type_id = $_POST['id'];

        if ($type == 'add') {
            if ($task->insert($value)) $response['data'] = $task->get($value);
            else $response['status'] = 'error';
        } else if ($type == 'list' && $value) {
            $response['data'] = $task->get($value);
        } else if ($type == 'completed' || $type == 'active') {
            if ($task->changeStatus($value, $type)) $response['data'] = $task->get($value);
            else $response['status'] = 'error';
        } else if ($type == 'delete') {
            if ($value == 'completed') {
                if ($task->deleteCompletedList()) {
                } else $response['status'] = 'error';
            } else {
                if ($task->delete($value)) $response['data'] = $task->get($value);
                else $response['status'] = 'error';
            }
        } else if ($type == 'update' && $type_id) {
            if ($task->update($type_id, $value)) $response['data'] = $task->get($value);
            else $response['status'] = 'error';
        }

        if ($response['status'] == 'error') {
            $response['message'] = 'Something went wrong!';
        } else {
            $response['total_active'] = $task->countTasksByStatus('active');
            $response['total_completed'] = $task->countTasksByStatus('completed');
        }

        echo json_encode($response);
        die();
    }
}
