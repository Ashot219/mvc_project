<?php


class UserController
{
    public function actionLogin()
    {
        $message = '';
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password = $this->pass_hash($password);
            $user = new User();
            $check_logged = $user->checkLogged($username, $password);
            if ($check_logged) {
                $_SESSION['user'] = $check_logged['id'];
                header("Location: /mvc_project/tasks");
                exit();
            } else {
                $message = 'The username or/and password are wrong!';
            }
        }

        require_once(ROOT . '/views/login/index.php');
        return true;
    }

    public function actionLogout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header("Location: /mvc_project/tasks");
        exit();
    }

    public function pass_hash($pass)
    {
        $salt = 'same_salt';
        return hash('sha256', $salt . $pass);
    }


}