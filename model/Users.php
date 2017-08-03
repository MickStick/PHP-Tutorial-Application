<?php
    class Users{
        public static $id;
        public static $username;
        public static $password;
        public static $fname;
        public static $lname;
        public static $propic;
        public static $email;

        public static function setID($Id){
            $id = $Id;
        }

        public static function getID(){
            return $id;
        }

        public static function setUsername($Username){
            $username = $Username;
        }

        public static function getUsername(){
            return $username;
        }

        public static function setPassword($Password){
            $password = $Password;
        }

        public static function getPassword(){
            return $password;
        }

        public static function setFname($Fname){
            $fname = $Fname;
        }

        public static function getFname(){
            return $fname;
        }

        public static function setLname($Lname){
            $lname = $Lname;
        }

        public static function getLname(){
            return $lname;
        }

        public static function setPropic($Propic){
            $propic = $Propic;
        }

        public static function getPropic(){
            return $propic;
        }

        public static function setEmail($Email){
            $email = $Email;
        }

        public static function getEmail(){
            return $email;
        }

        public static function convID($id){
            $convid = hash('sha256',$id);
            return $convid;
        }

        public static function convPWD($pwd){
            $PWD = hash('sha256',$pwd);
            return $PWD;
        }
        
    }
?>