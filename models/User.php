<?php


class User extends Model
{
    public static function checkLogged($username, $password){
        $db = Db::getConnectionMySqli();

        $ret_val = false;

        $db->where('username', $username);
        $db->where('password', $password);
        $result = $db->getOne('tw_users');
        if ($result){
            $ret_val = $result;
        }
        return $ret_val;
    }

    public static function getUserById($user_id){
        $db = Db::getConnectionMySqli();

        $db->where('id', $user_id);
        $result = $db->getOne('tw_users');
        return $result;
    }

    public function insertUser($ins_array){
        $db = Db::getConnectionMySqli();

        $db->where('username', $ins_array['username']);
        $db->orWhere('password', $ins_array['password']);
        $result = $db->getOne('tw_users');
        if (!$result) {
            $db->insert('tw_users', $ins_array);
            $ret_val = true;
        }else{
            $ret_val = 'The username or/and password are exist!';
        }
        return $ret_val;
    }
}