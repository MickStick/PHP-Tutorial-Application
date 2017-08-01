<?php
    class Users{
        public $id = "";
        public $username = "";
        public $password = "";
        public $fname = "";
        public $lname = "";
        public $propic = "";
        public $email = "";

        public function setID($id){
            this.$id = $id;
        }

        public function getID(){
            return $id;
        }

        public function setUsername($username){
            this.$username = $username;
        }

        public function getUsername(){
            return $username;
        }

        public function setPassword($password){
            this.$password = $password;
        }

        public function getPassword(){
            return $password;
        }

        public function setFname($fname){
            this.$fname = $fname;
        }

        public function getFname(){
            return $fname;
        }

        public function setLname($lname){
            this.$lname = $lname;
        }

        public function getLname(){
            return $lname;
        }

        public function setPropic($propic){
            this.$propic = $propic;
        }

        public function getPropic(){
            return $propic;
        }

        public function setEmail($email){
            this.$email = $email;
        }

        public function getEmail(){
            return $email;
        }

        public function convID($id){
            $convid = hash('sha256',$id);
            return $convid;
        }

        public static function convPWD($pwd){
            $PWD = hash('sha256',$pwd);
            return $PWD;
        }
        
    }
?>