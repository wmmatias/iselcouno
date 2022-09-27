<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {
    
    /*  DOCU: This function is triggered by default which displays the sign in/dashboard.
        Owner: Wilard
    */
    public function index() 
    {   
        $current_user_id = $this->session->userdata('user_id');
        if(!$current_user_id) { 
            $this->load->view('templates/header');
            $this->load->view('client/index');
            $this->load->view('templates/footer');
        } 
        else {
            redirect("dashboard");
        }
    }
}