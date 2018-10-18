<?php

namespace Mapi\src\task;

/**
 * Class Task
 * @package Mapi
 */
class Task extends \Mapi\App\Models\Model
{
    /**
     * @param $title
     * @param $description
     * @return mixed
     */
    public function create($title, $description)
    {
        $sql = "INSERT INTO tasks (id, title, description, created_at, updated_at) 
        VALUES (:id, :title, :description, :created_at, :updated_at)";
        $req = \Mapi\Config\Database::getBdd()->prepare($sql);

        return $req->execute(
            [
                'id' => rand(),
                'title' => $title,
                'description' => $description,
                'created_at' => '',
                'updated_at' => '',
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showTask($id)
    {
        $sql = "SELECT * FROM tasks WHERE id =".$id;
        $req = \Mapi\Config\Database::getBdd()->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    /**
     * @return mixed
     */
    public function showAllTasks()
    {
        $sql = "SELECT * FROM tasks";
        $req = \Mapi\Config\Database::getBdd()->prepare($sql);
        $req->execute();

        return $req->fetchAll();
    }

    /**
     * @param $id
     * @param $title
     * @param $description
     * @return mixed
     */
    public function edit($id, $title, $description)
    {
        $sql = "UPDATE tasks SET title = :title, description = :description , updated_at = :updated_at WHERE id = :id";
        $req = \Mapi\Config\Database::getBdd()->prepare($sql);

        return $req->execute(
            [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM tasks WHERE id = ?';
        $req = \Mapi\Config\Database::getBdd()->prepare($sql);

        return $req->execute([$id]);
    }
}
