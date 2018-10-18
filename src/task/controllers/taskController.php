<?php

namespace Mapi\src\task;

/**
 * Task Controller
 *
 * PHP version 7.2
 *
 * @category Src
 * @package  Mapi
 * @author   David Raleche <davidr@raleche.com>
 * @license  http://mapi.raleche.com/docs/swagger.json raleche
 * @link     https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/673513891/Framework+Architecture+Demo
 */

class TaskController extends \Mapi\App\controllers\Controller
{

    /**
     * Get Simple endpoint
     *
     * @return mixed
     *
     * @OA\Get(
     *   path="/mapi/task/simple",
     *   tags={"API demo"},
     *   summary="Get Simple endpoint",
     *   @OA\Response(
     *     response=200,
     *     description="return simple response"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function simple()
    {
        echo 'simple';
    }

    /**
     * Get list orders
     *
     * @return mixed
     * @OA\Post(
     *   path="/mapi/task/index",
     *   tags={"API demo"},
     *   summary="get organisation UUID",
     *   @OA\Response(
     *     response=200,
     *     description="return organisation UUID"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function index()
    {
        require(ROOT . 'src/task/models/Task.php');
        $tasks = new \Mapi\src\task\Task();
        $d['tasks'] = $tasks->showAllTasks();
        $this->set($d);
        $this->render("index");
    }

    /**
     * Create Order
     *
     * @return mixed
     * @OA\Post(
     *   path="/mapi/task/create",
     *   tags={"API demo"},
     *   summary="Create Order",
     *   @OA\Response(
     *     response=200,
     *     description="return organisation UUID"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function create()
    {
        if (isset($_POST["title"])) {
            require(ROOT . 'src/task/models/Task.php');
            $task= new Task();

            if ($task->create($_POST["title"], $_POST["description"])) {
                header("Location: " . WEBROOT . "mapi/task/index");
            }
        }
        $this->render("create");
    }

    /**
     * Edit Task
     *
     * @return mixed
     * @OA\Post(
     *   tags={"API demo"},
     *   path="/mapi/task/edit",
     *   summary="Edit Task",
     *   @OA\Response(
     *     response=200,
     *     description="edit Task"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function edit($id)
    {

        require(ROOT . 'src/task/models/Task.php');
        $task= new Task();

        $d["task"] = $task->showTask($id);
        if (isset($_POST["title"]) && ($task->edit($id, $_POST["title"], $_POST["description"]))) {
                header("Location: ".WEBROOT."mapi/task/index");
        }

        $this->set($d);
        $this->render("edit");
    }


    /**
     * Delete Task
     *
     * @return mixed
     * @OA\Delete(
     *   tags={"API demo"},
     *   path="/mapi/task/edit",
     *   summary="Edit Task",
     *   @OA\Response(
     *     response=200,
     *     description="edit Task"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function delete($id)
    {
        require(ROOT . 'src/task/models/Task.php');
        $task = new Task();
        if ($task->delete($id)) {
            header("Location: " . WEBROOT . "mapi/task/index");
        }
    }
}
