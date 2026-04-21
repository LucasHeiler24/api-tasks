<?php 
namespace src\class;

class Validation {

    public static function cleanInputs(array $data){
        $clean = [];
        foreach($data as $key => $value){
            $clean[$key] = trim(strip_tags($value));
            if(is_numeric($clean[$key]))
                $clean[$key] = (int)$clean[$key];
        }
        return $clean;
    }

    public static function signup(array $data){
        $errors = [];

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $errors[] = ['field' => 'email', 'error' => 'E-mail is invalid!'];
        if(strlen($data['full_name']) <= 2)
            $errors[] = ['field' => 'full_name', 'error' => 'Full name is invalid!'];
        if(strlen($data['password']) < 6)
            $errors[] = ['field' => 'password', 'error' => 'Password is too small!'];

        return $errors;
    }

    public static function task(array $data){
        $errors = [];

        if(strlen($data['description']) < 3)
            $errors[] = ['field' => 'description', 'error' => 'Description is too small!'];
        if(!validateDate($data['date']))
            $errors[] = ['field' => 'date', 'error' => 'Date is invalid!'];
        if($data['is_done'] != "done" && $data['is_done'] != "pending")
            $errors[] = ['field' => 'is_done', 'error' => 'Must be status done or pending!'];
        if(!is_int($data['user_id']))
            $errors[] = ['field' => 'user+id', 'error' => 'Must be an integer!'];

        return $errors;
    }

}