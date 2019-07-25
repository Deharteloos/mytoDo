<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 25/07/2019
 * Time: 09:27
 */

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['formerPwd']) && isset($data['newPwd']) && isset($data['pwd']) && isset($data['id'])) {

    require __DIR__ . '/Admin.php';

    $fpwd = $data['formerPwd'];
    $npwd = $data['newPwd'];
    $id = $data['id'];
    $pwd = $data['pwd'];

    $admin = new Admin();
    echo $admin->UpdatePassword($fpwd, $npwd, $pwd, $id);
}
