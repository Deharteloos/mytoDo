<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 24/07/2019
 * Time: 12:08
 */

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['username']) && isset($data['name']) && isset($data['email']) && isset($data['id'])) {

    require __DIR__ . '/User.php';

    $name = $data['name'];
    $username = $data['username'];
    $id = $data['id'];
    $email = $data['email'];

    $user = new User();
    $user->Update($username, $name, $email, $id);
}
