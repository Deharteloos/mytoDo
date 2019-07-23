<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 23/07/2019
 * Time: 10:13
 */


$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['task']) && isset($data['user_id'])) {

    require __DIR__ . '/Task.php';

    //$name = (isset($data['task']['name']) ? $data['task']['name'] : NULL);
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
    $user_id = $data['user_id'];

    $task = new Task();
    echo $task->Create($title, $description, $duration, $started_at, $ended_at, $user_id);
}
