<?php


class TaskController
{
    public function actionIndex()
    {
        $task_obj = new Task();
        $tasks = $task_obj->getTasks();
        $message = '';
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
        }
        unset($_SESSION['message']);

        $modified_arr = array(
            'Not modified',
            'Modified by admin'
        );

        $status_arr = array(
            'In process',
            'Success'
        );

        require_once(ROOT . '/views/tasks/list.php');
        return true;
    }

    public function actionCreate()
    {

        $task = new Task();
        $tasks = $task->getTasks();

        require_once(ROOT . '/views/tasks/create_task.php');
        return true;
    }

    public function actionSave()
    {

        if (isset($_POST['submit'])) {

            $username = $_POST['username'];
            $email = $_POST['email'];
            $task = $_POST['task'];
            $task = htmlspecialchars($task);
            $ins_array = array(
                'guid' => $this->generateGuid(),
                'username' => $username,
                'email' => $email,
                'task' => $task,
                'create_date' => date('Y-m-d H:i:s'),
            );
            $task_obj = new Task();
            $task_insert_message = $task_obj->insertTask($ins_array);
            $_SESSION['message'] = $task_insert_message;

        }

        header("Location: /mvc_project/tasks");
        exit();
    }

    public function actionEdit($guid)
    {
        $task_obj = new Task();
        $task_row = $task_obj->getTaskByGuid($guid);
        if ($task_row) {

            require_once(ROOT . '/views/tasks/edit_task.php');
            return true;
        } else {
            if (isset($_POST['submit']) && isset($_SESSION['user'])) {
                $guid = $_POST['guid'];
                $task = $_POST['task'];
                $task = htmlspecialchars($task);
                $upd_array = array(
                    'task' => $task,
                    'update_date' => date('Y-m-d H:i:s'),
                    'status' => 0
                );

                $task_obj = new Task();
                $task_row = $task_obj->getTaskByGuid($guid);

                if ($task_row) {
                    if ($task_row['task'] != $task) {
                        $upd_array['is_modified'] = 1;
                    }

                    if (isset($_POST['status']) && $_POST['status'] == 'on'){
                        $upd_array['status'] = 1;
                    }

                    $_SESSION['message'] = $task_obj->updateTask($guid, $upd_array);
                    header("Location: /mvc_project/tasks");
                    exit();
                }
            }

            $_SESSION['message'] = 'Sorry. You can`t edit this task!';
            header("Location: /mvc_project/tasks");
            exit();
        }
    }


    public function generateGuid()
    {
        $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $GUID = substr(str_shuffle(str_repeat($alpha_numeric, 62)), 0, 35);
        return $GUID;
    }

}