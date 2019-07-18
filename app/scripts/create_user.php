<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['user'])) {

    require __DIR__ . '/User.php';

    //$name = (isset($data['task']['name']) ? $data['task']['name'] : NULL);
    $name = $data['user']['name'];
    $username = $data['user']['username'];
    $password = $data['user']['password'];
    $email = $data['user']['email'];

    // validated the request
    /* if ($name == NULL) {
        http_response_code(400);
        echo json_encode(['errors' => ["Name Field is required"]]);

    } else {

        // Add the task
        $task = new Task();

        echo $task->Create($name, $description);
    } */
    $user = new User();
    $user->Create($name, $email, $username, $password);
}
