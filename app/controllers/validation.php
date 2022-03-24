<?php
class Validation{
    function __construct(){

    }
    public function check($userName,  $email,$password, $checkPass, $min=null, $max=null){
        $space=trim($email," ");
        $na=trim($userName," ");
        $required=$this->required($na, $space,$password, $checkPass);
        $Email= $this->checkEmail($space);
        $length= $this->minMax($na,$min, $max,"Name");
        $passlength= $this->minMax($password,$min, $max,"Password");
        $array=[
            $required,
            $Email,
            $length,
            $passlength

        ];
        foreach ($array as $key => $value) {
            # code...
            if ($value !== "pass") {
                # code...
                return $value;
                break;
            }
        }
        return "pass";

    }
    function required($userName,  $email,$password, $checkPass){
        $array=[
            "Name"=>$userName,
            "Email"=>$email,
            "Password" =>  $password,
            "confirm password" => $checkPass
        ];
        foreach ($array as $key => $value) {
          

            if($value==""){
                return "$key Field is required";
                break;
            }
        }
        return "pass";

    }
    function checkEmail($email){
        if(  filter_var($email, FILTER_VALIDATE_EMAIL)){
          return "pass";

        }
        else return "valid Email";


    }
    function minMax($feild, $min, $max, $name){
        $length= strlen($feild);
        if($length<$min){
            return " Feild $name manimum more than  $min character ($max max)";
        }elseif($length<$max){
            return " Feild $name manimum more than  $max character ($min max)";
        }
        return "pass";
        
    }
}
?>