<?php

require __DIR__ . '/connection.php';

/**
 * Class User
 */
class User
{

    /**
     * @var mysqli|PDO|string
     */
    protected $db;

    /**
     * Task constructor.
     */
    public function __construct()
    {
        $this->db = DB();
    }

    /**
     * Add new User
     *
     * @param $name
     * @param $email
     * @param $username
     * @param $password
     *
     * @return string
     */
    public function Create($name, $email, $username, $password)
    {
        $passHashed = password_hash($password, PASSWORD_BCRYPT);

        $query = $this->db->prepare("INSERT INTO users(name, username, password, email) VALUES (:name,:username,:password,:email)");
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password", $passHashed, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();

        return json_encode(['user' => [
                                        'id'        => $this->db->lastInsertId(),
                                        'name'      => $name,
                                        'username'  => $username,
                                        'password'  => $passHashed,
                                        'email'     => $email
                                        ]
                            ]);
    }

    /**
     * Get specific user
     *
     * @return string
     */
    public function get_user($username)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    /**
     * List Tasks
     *
     * @return string
     */
    public function getTasks($id)
    {
        $query = $this->db->prepare("SELECT * FROM tasks WHERE user_id = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return json_encode(['tasks' => $data]);
    }


    /**
     * Update User
     *
     * @param $username
     * @param $name
     * @param $email
     */
    public function Update($username, $name, $email, $user_id)
    {
        $query = $this->db->prepare("UPDATE users SET username = :username, name = :name, email = :email WHERE id = :id");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("id", $user_id, PDO::PARAM_STR);
        $query->execute();
    }

    /**
     * Update User Password
     *
     * @param $formerPwd
     * @param $newPwd
     * @param $pwd
     * @param $user_id
     * @return string
     */
    public function UpdatePassword($formerPwd, $newPwd, $pwd, $user_id)
    {
        if(!password_verify($formerPwd, $pwd)) {
            return json_encode(['error' => 'Mauvais mot de passe']);
        }
        else {
            $newPwd = password_hash($newPwd, PASSWORD_BCRYPT);
            $query = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
            $query->bindParam("password", $newPwd, PDO::PARAM_STR);
            $query->bindParam("id", $user_id, PDO::PARAM_STR);
            $query->execute();
            return json_encode(['pwd' => $newPwd]);
        }
    }

    /**
     * Delete Task
     *
     * @param $task_id
     */
    public function Delete($task_id)
    {
        $query = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        $query->bindParam("id", $task_id, PDO::PARAM_STR);
        $query->execute();
    }
}
