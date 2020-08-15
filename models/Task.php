<?php


class Task extends Model
{
    public function getTasks(){
        $db = Db::getConnectionMySqli();

        $db->orderBy('username', 'ASC');
        $result = $db->get('tw_tasks');
        return $result;
    }

    public function insertTask($ins_array){
        $db = Db::getConnectionMySqli();

        $result = $db->insert('tw_tasks', $ins_array);

        if ($result){
            $ret_val = 'The task created successfully';
        }else{
            $ret_val = $db->getLastError();
        }

        return $ret_val;
    }

    public function updateTask($guid, $upd_array){
        $db = Db::getConnectionMySqli();

        $db->where('guid', $guid);
        $result = $db->update('tw_tasks', $upd_array);

        if ($result){
            $ret_val = 'The task successfully updated';
        }else{
            $ret_val = $db->getLastError();
        }

        return $ret_val;
    }

    public function getTaskByGuid($guid){
        $db = Db::getConnectionMySqli();

        $db->where('guid', $guid);
        $result = $db->getOne('tw_tasks');
        return $result;
    }

}