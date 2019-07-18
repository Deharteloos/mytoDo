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
        ]]);
    }

    /**
     * List Tasks
     *
     * @return string
     */
    public function Read()
    {
        $query = $this->db->prepare("SELECT * FROM tasks");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return json_encode(['tasks' => $data]);
    }


    /**
     * Update Task
     *
     * @param $name
     * @param $description
     * @param $task_id
     */
    public function Update($name, $description, $task_id)
    {
        $query = $this->db->prepare("UPDATE tasks SET name = :name, description = :description WHERE id = :id");
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("description", $description, PDO::PARAM_STR);
        $query->bindParam("id", $task_id, PDO::PARAM_STR);
        $query->execute();
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
