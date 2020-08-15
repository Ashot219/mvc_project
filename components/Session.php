<?php

/**
 * Session.php
 * 
 * The Session class is meant to simplify the task of keeping
 * track of logged in users and also guests.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 * Modified by: Arman G. de Castro, October 3, 2008
 * email: armandecastro@gmail.com
 */

include 'Db.php';

class Session {

    public $username;     //Username given on sign-up
    public $userid;       //current user id
    public $userlevel;    //The level to which the user pertains
    public $time;         //Time user was last active (page loaded)
    public $logged_in;    //True if user is logged in, false otherwise
    public $userinfo = array();  //The array holding all user info
    public $url;          //The page url current being viewed
    public $referrer;     //Last recorded site page viewed
    public $login_time;
    public $permissions;
    public $home_path;

    /**
     * Note: referrer should really only be considered the actual
     * page referrer in process.php, any other time it may be
     * inaccurate.
     */
    /* Class constructor */

    public function __construct() {
        $db = Db::getConnectionMySqli();
        $this->time = time();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }   //Tell PHP to start the session

        /* Determine if user is logged in */
        $this->logged_in = $this->checkLogin();
    }

    public function checkLogin() {


        $db = Db::getConnectionMySqli();

        /* Check if user has been remembered */
        if (isset($_SESSION['username']) && isset($_SESSION['userid'])) {
            $this->username = $_SESSION['username'];
            $this->userid = $_SESSION['userid'];
            $this->userlevel = $_SESSION['userlevel'];
            $this->home_path = $_SESSION['home_path'];
            $this->login_time = $_SESSION['login_time'];
            $this->permissions = $_SESSION['permissions'];
            //if($_SESSION['remember']==true) session_set_cookie_params (time()+13600);
            session_set_cookie_params (time()+86400);

            return true;
        } else {
            if (isset($_COOKIE['remember']) && $_COOKIE['remember'] == 'yes') {
                $db->where('uname', $_COOKIE['uname']);
                $db->where('pass', $_COOKIE['pass']);
                $db->where('active', '1');
                $users = $db->get('users', 1);
                if ($users) {
                    $this->username = $users[0]['uname'];
                    $this->userid = $users[0]['id'];
                    $this->userlevel = $users[0]['roleID'];

                    $_SESSION['username'] = $this->username;
                    $_SESSION['userid'] = $this->userid;
                    $_SESSION['userlevel'] = $this->userlevel;
                    $_SESSION['login_time'] = time();
                    $_SESSION['permissions'] = 1;
                    $_SESSION['home_path'] = $users[0]['home_path'];
                    return true;
                }
            }
        }
        return false;


    }

    /**
     * login - The user has submitted his username and password
     * through the login form, this function checks the authenticity
     * of that information in the database and creates the session.
     * Effectively logging in the user if all goes well.
     */
    public function login($uname, $pass, $remember) {

        $db = Db::getConnectionMySqli();
        if (isset($uname) && isset($pass)) {
            $db->where('uname', $uname);
            $db->where('pass', $this->pass_hash($pass));
            $db->where('active', '1');
            $users = $db->get('users', 1);
            if ($users) {
                if ($remember == 'on') {
                    setcookie('uname', $uname, time() + 360000, '/');
                    setcookie('pass', $this->pass_hash($pass), time() + 360000, '/');
                    setcookie('remember', 'yes', time() + 360000, '/');
                }
                $_SESSION['username'] = $users[0]['uname'];
                $_SESSION['userid'] = $users[0]['id'];
                $_SESSION['userlevel'] = $users[0]['roleID'];
                $_SESSION['login_time'] = time();
                $_SESSION['permissions'] = 1;
                $_SESSION['home_path'] = $users[0]['home_path'];


                return true;
            } else
                return false;
        }

        /* Login completed successfully */
        return false;
    }

    /**
     * logout - Gets called when the user wants to be logged out of the
     * website. It deletes any cookies that were stored on the users
     * computer as a result of him wanting to be remembered, and also
     * unsets session variables and demotes his user level to guest.
     */
    public function pass_hash($pass) {
        $salt = '$5$rounds=5';
        return hash('sha256', $salt . $pass);
    }

    protected function valida() {

    }

    public static function logout() {

        session_destroy();

        setcookie("remember", "", time() - 3600);
        setcookie("uname", "", time() - 3600);
        setcookie("pass", "", time() - 3600);
    }

}

/**
 * Initialize session object - This must be initialized before
 * the form object because the form uses session variables,
 * which cannot be accessed unless the session has started.
 */
$session = new Session;
?>
