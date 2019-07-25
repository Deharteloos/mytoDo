<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 24/07/2019
 * Time: 16:22
 */

require __DIR__ . '\connection.php';

/**
 * Class Admin
 */
class Admin
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
     * Add new Admin
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

        $query = $this->db->prepare("INSERT INTO admins(name, username, password, email) VALUES (:name,:username,:password,:email)");
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
     * Get specific admin
     *
     * @return string
     */
    public function get_admin($username)
    {
        $query = $this->db->prepare("SELECT * FROM admins WHERE username = :username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $admin = $query->fetch(PDO::FETCH_ASSOC);
        return $admin;
    }

    /**
     * List Tasks
     *
     * @return string
     */
    public function getTasks()
    {
        $query = $this->db->prepare("SELECT * FROM tasks");
        //$query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return json_encode(['tasks' => $data]);
    }


    /**
     * Update Admin
     *
     * @param $username
     * @param $name
     * @param $email
     * @param $admin_id
     */
    public function Update($username, $name, $email, $admin_id)
    {
        $query = $this->db->prepare("UPDATE admins SET username = :username, name = :name, email = :email WHERE id = :id");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("id", $admin_id, PDO::PARAM_STR);
        $query->execute();
    }

    /**
     * Update Admin Password
     *
     * @param $formerPwd
     * @param $newPwd
     * @param $pwd
     * @param $admin_id
     * @return string
     */
    public function UpdatePassword($formerPwd, $newPwd, $pwd, $admin_id)
    {
        if(!password_verify($formerPwd, $pwd)) {
            return json_encode(['error' => 'Mot de passe incorrect']);
        }
        else {
            $newPwd = password_hash($newPwd, PASSWORD_BCRYPT);
            $query = $this->db->prepare("UPDATE admins SET password = :password WHERE id = :id");
            $query->bindParam("password", $newPwd, PDO::PARAM_STR);
            $query->bindParam("id", $admin_id, PDO::PARAM_STR);
            $query->execute();
            return json_encode(['pwd' => $newPwd]);
        }
    }
}