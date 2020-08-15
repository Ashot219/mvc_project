<?php

class functions {

    public function get_post($post_key) {
        if (isset($_POST[$post_key]) && !empty($_POST[$post_key])) {
            $data = $_POST[$post_key];
            return $data;
        } else
            return null;
    }

    public function define_post($post_key) {
        if (is_array($post_key)) {
            foreach ($post_key as $value) {
                if (isset($_POST[$value]) && !empty($_POST[$value])) {
                    $data = $_POST[$value];
                    $GLOBALS[$value] = trim($data);
                } else
                    $GLOBALS[$value] = '';
            }
        }else {
            if (isset($_POST[$post_key]) && !empty($_POST[$post_key])) {
                $data = $_POST[$post_key];
                $GLOBALS[$post_key] = trim($data);
            } else
                $GLOBALS[$post_key] = '';
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}

$func = new functions;
