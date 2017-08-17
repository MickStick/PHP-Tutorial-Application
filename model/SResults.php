<?php
    class SResults{
        public $id = array();
        public $frname = array();
        public $lname = array();
        public $propic = array();
        
        public function setID($key,$id){
            $this->id[$key] = $id;
        }
        
        public function getID($key){
            return $this->id[$key];
        }
        
        public function setFname($key, $fname){
            $this->fname[$key] = $fname;
        }
        
        public function getFname($key){
            return $this->fname[$key];
        }
        
        public function setLname($key, $lname){
            $this->lname[$key] = $lname;
        }
        
        public function getLname($key){
            return $this->lname[$key];
        }
        
        public function setProPic($key,$propic){
            $this->propic[$key] = $propic;
        }
        
        public function getProPic($key){
            return $this->propic[$key];
        }
    }
?>