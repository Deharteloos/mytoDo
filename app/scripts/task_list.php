<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 22/07/2019
 * Time: 14:56
 */

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['id'])) {
    require __DIR__ . '/User.php';
    $user = new User();
    echo $user->getTasks($data['id']);
}
else
    echo 'ID not set';
