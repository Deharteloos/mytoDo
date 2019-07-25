<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 24/07/2019
 * Time: 16:21
 */

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['pseudo']) && isset($data['password'])) {

    require __DIR__ . '/Admin.php';

    $username = $data['pseudo'];
    $password = $data['password'];
    $ad = new Admin();
    $admin = $ad->get_admin($username);
    if(password_verify($password, $admin['password'])) {
        echo json_encode([
            'result' => 'Authentification réussie',
            'admin' => [
                'id'        => $admin['id'],
                'name'      => $admin['name'],
                'username'  => $admin['username'],
                'email'     => $admin['email'],
                'password'  => $admin['password']
            ]]);
    }
    else {
        echo json_encode(['result' => 'Echec de l\'authentification', 'admin' => []]);
    }
}
