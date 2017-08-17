<?php
    class Users{
        public $id;
        public $username;
        public $password;
        public $fname;
        public $lname;
        public $propic;
        public $email;
        

        public function setID($Id){
            $this->id = $Id;
        }

        public function getID(){
            return $this->id;
        }

        public function setUsername($Username){
            $this->username = $Username;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setPassword($Password){
            $this->password = $Password;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setFname($Fname){
            $this->fname = $Fname;
        }

        public function getFname(){
            return $this->fname;
        }

        public function setLname($Lname){
            $this->lname = $Lname;
        }

        public function getLname(){
            return $this->lname;
        }

        public function setPropic($Propic){
            $this->propic = $Propic;
        }

        public function getPropic(){
            return $this->propic;
        }

        public function setEmail($Email){
            $this->email = $Email;
        }

        public function getEmail(){
            return $this->email;
        }

        public function convID($id){
            $convid = hash('sha256',$id);
            return $convid;
        }

        public function convPWD($pwd){
            $PWD = hash('sha256',$pwd);
            return $PWD;
        }
        
    }
?>