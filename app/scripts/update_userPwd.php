<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 24/07/2019
 * Time: 12:58
 */

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['formerPwd']) && isset($data['newPwd']) && isset($data['pwd']) && isset($data['id'])) {

    require __DIR__ . '/User.php';

    $fpwd = $data['formerPwd'];
    $npwd = $data['newPwd'];
    $id = $data['id'];
    $pwd = $data['pwd'];

    $user = new User();
    echo $user->UpdatePassword($fpwd, $npwd, $pwd, $id);
}
