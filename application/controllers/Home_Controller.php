<?php

class Home_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        // Load the home page
        $this->load->view('pages/home');
    }

}

?>