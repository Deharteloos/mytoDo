<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 25/07/2019
 * Time: 09:00
 */

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['username']) && isset($data['name']) && isset($data['email']) && isset($data['id'])) {

    require __DIR__ . '/Admin.php';

    $name = $data['name'];
    $username = $data['username'];
    $id = $data['id'];
    $email = $data['email'];

    $admin = new Admin();
    $admin->Update($username, $name, $email, $id);
}
