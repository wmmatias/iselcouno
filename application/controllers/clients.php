<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

    public function index_html() 
    {   
        $res = $this->client->get_info($this->session->userdata('user_id'));
        $data = array ('data' => $res);
	    $this->load->view("partials/client_profile", $data);
    }

    // public function index_html() 
    // {   
    //     $res = $this->client->get_info($this->session->userdata('user_id'));
    //     $data = array ('data' => $res);
	//     $this->load->view("partials/client_profile", $data);
    // }

    public function index() 
    {   
        $user = $this->session->userdata('user_id');
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            // $this->load->view('templates/header');
            // $this->load->view('client/index');
            // $this->load->view('templates/footer');
            $this->client();
        }
        else{
            redirect('dashboards');
        }
    }

    
    public function client() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            // $appid = $this->client->get_application_status($this->session->userdata('user_id'));
            // $res = $this->client->get_timeline($appid);
            $application = $this->client->get_application_details($this->session->userdata('user_id'));
            $product = $this->dashboard->fetch_all_product();
            $data = array('app'=>$application, 'product'=>$product);
            $this->load->view('templates/header', $data);
            $this->load->view('client/index', $data);
            $this->load->view('templates/footer');
        }
        else{
            redirect('dashboards');
        }
    }

    public function send() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            $res = $this->user->resend_details($this->session->userdata('user_id'));
            $this->email->resend($res);
            $this->session->set_flashdata('success', 'An Email has been sent to your account!');
            redirect('/');
        }
        else{
            redirect('dashboards');
        }
    }

    public function users_modification()
    {   
        $form_data = $this->input->post();
        $res = $this->user->checkrules();
        if($res !== 'success'){
            $this->session->set_flashdata('profile_error', $res);
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res);
            $this->load->view("partials/client_profile", $data);
        }
        else{
            $this->session->set_flashdata('success', 'Successfully Update!');
            $this->user->update_user_details($form_data);
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res);
            $this->load->view("partials/client_profile", $data);
        }
    }

    public function credentials_modification()
    {   
        $form_data = $this->input->post();
        $res = $this->user->validate_change_password($form_data);
        if(!empty($res)){
            $this->session->set_flashdata('password_error', $res);
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res);
            $this->load->view("partials/client_profile", $data);
        }
        else{
            $this->user->update_credentials($form_data);
            $this->session->set_flashdata('success_password', 'Successfully Update!');
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res);
            $this->load->view("partials/client_profile", $data);
        }
    }

    public function show($id)
    {
        $espicific_app = $this->client->get_application_details_by_id($id);
        header('Content-Type: application/json');
        echo json_encode($espicific_app);
    }

    public function product_show($id)
    {
        $espicific_product = $this->client->get_product_details_by_id($id);
        header('Content-Type: application/json');
        echo json_encode($espicific_product);
    }
 
}