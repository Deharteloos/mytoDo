<?php
/**
 * Created by IntelliJ IDEA.
 * User: Boris Ebwanga
 * Date: 23/07/2019
 * Time: 10:28
 */

require __DIR__ . '/connection.php';


/**
 * Class Task
 */
class Task
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
     * Add new Task
     *
     * @param $title
     * @param $description
     * @param $duration
     * @param $started_at
     * @param $ended_at
     * @param $user_id
     *
     * @return string
     */
    public function Create($title, $description, $duration, $started_at, $ended_at, $user_id)
    {
        $query = $this->db->prepare("INSERT INTO tasks (title, description, duration, started_at, ended_at, user_id) VALUES (:title,:description,:duration,:started_at,:ended_at,:user_id)");
        $query->bindParam("title", $title, PDO::PARAM_STR);
        $query->bindParam("description", $description, PDO::PARAM_STR);
        $query->bindParam("duration", $duration, PDO::PARAM_STR);
        $query->bindParam("started_at", $started_at, PDO::PARAM_STR);
        $query->bindParam("ended_at", $ended_at, PDO::PARAM_STR);
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->execute();

        return json_encode(['nTask' => [
            'id'        => $this->db->lastInsertId(),
            'title'      => $title,
            'description'  => $description,
            'duration'     => $duration,
            'started_at'  => $started_at,
            'ended_at'  => $ended_at,
            'user_id'   => $user_id
        ]
        ]);
    }

    /**
     * Update Task
     *
     * @param $id
     * @param $title
     * @param $description
     * @param $duration
     * @param $started_at
     * @param $ended_at
     */
    public function Update($id, $title, $description, $duration, $started_at, $ended_at)
    {
        $query = $this->db->prepare("UPDATE tasks SET title = :title, description = :description, duration = :duration, started_at = :started_at, ended_at = :ended_at WHERE id = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->bindParam("title", $title, PDO::PARAM_STR);
        $query->bindParam("description", $description, PDO::PARAM_STR);
        $query->bindParam("duration", $duration, PDO::PARAM_STR);
        $query->bindParam("started_at", $started_at, PDO::PARAM_STR);
        $query->bindParam("ended_at", $ended_at, PDO::PARAM_STR);
        $query->execute();
    }

}