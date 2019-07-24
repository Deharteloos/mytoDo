<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 18/07/2019
 * Time: 16:07
 */

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['pseudo']) && isset($data['password'])) {

    require __DIR__ . '/User.php';

    $username = $data['pseudo'];
    $password = $data['password'];
    $usr = new User();
    $user = $usr->get_user($username);
    if(password_verify($password, $user['password'])) {
        echo json_encode([
            'result' => 'Authentification réussie',
            'user' => [
                'id'        => $user['id'],
                'name'      => $user['name'],
                'username'  => $user['username'],
                'email'     => $user['email'],
                'password'  => $user['password'],
                'created_by'=> $user['created_by']
            ]]);
    }
    else {
        echo json_encode(['result' => 'Echec de l\'authentification', 'user' => []]);
    }
}
