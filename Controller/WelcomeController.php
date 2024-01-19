<?php
    include ("utilities/View.php");

    Class WelcomeController extends View {
        
        public function index(){
            return $this->view("welcome.php",[]);
        }
    }