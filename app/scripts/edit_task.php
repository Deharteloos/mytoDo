<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 23/07/2019
 * Time: 16:17
 */

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['task'])) {

    require __DIR__ . '/Task.php';

    $id = $data['task']['id'];
    $title = $data['task']['title'];
    $description = (isset($data['task']['description']) ? $data['task']['description'] : NULL);
    $duration = $data['task']['duration'];
    $started_at = (isset($data['task']['started_at']) ? $data['task']['started_at'] : NULL);
    if($started_at != null){
        $started_at = date_create($started_at);
        $started_at = date_format($started_at, 'Y-m-d H:i:s');
    }
    $ended_at = (isset($data['task']['ended_at']) ? $data['task']['ended_at'] : NULL);
    if($ended_at != null){
        $ended_at = date_create($ended_at);
        $ended_at = date_format($ended_at, 'Y-m-d H:i:s');
    }

    // Update the Task
    $task = new Task();
    $task->Update($id, $title, $description, $duration, $started_at, $ended_at);
}