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

    // public function index() 
    // {   
    //     $user = $this->session->userdata('user_id');
    //     $isadmin = $this->session->userdata('auth');
    //     if(!$isadmin){
    //         // $this->load->view('templates/header');
    //         // $this->load->view('client/index');
    //         // $this->load->view('templates/footer');
    //         $this->client();
    //     }
    //     else{
    //         redirect('dashboards');
    //     }
    // }

    
    public function index() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            $id = $this->session->userdata('user_id');
            $application = $this->client->get_application_details($id);
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

    public function add_application(){
        $form_data = $this->input->post();
        $result = $this->application->validate_add_prod();
        if($result!= 'success')
        {
            $this->session->set_flashdata('form_error', 'Something went wrong!' . ($result != 'success' ? '': ''));
            $this->load->view('templates/header');
            $this->load->view('client/index');
            $this->load->view('templates/footer');
        }
        elseif(empty($_FILES['files']['name'])){
            $this->session->set_flashdata('form_error', 'Something went wrong! requirement must have a value please secure your requirements');
            $this->load->view('templates/header');
            $this->load->view('client/index');
            $this->load->view('templates/footer');
        }
        else
        {
            $app_id = $this->application->create_new($form_data);
            $data = [];
   
            $count = count($_FILES['files']['name']);
          
            for($i=0;$i<$count;$i++){
          
              if(!empty($_FILES['files']['name'][$i])){
          
                $image = $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $new_name = time()."req".$image;
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];
        
                $config['upload_path'] = './assets/images/upload/requirements/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                $config['file_name'] = $new_name;
         
                $this->upload->initialize($config);
                if($this->upload->do_upload('file')){
                    $this->application->requirements($app_id,$new_name);
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $data['totalFiles'][] = $filename;
                }
              }
            }
            // $this->session->set_flashdata('success', 'Your product has beed add and subject for approval visit your <a href="#" data-bs-toggle="modal" data-bs-target="#application">Application</a> tab to check the status.');
            // redirect('/');
            $this->check_out($app_id);
        }
    }

    public function check_out($id){
        $res = $this->dashboard->fetch_application_id($id);
        $data = array('details'=>$res);
        $this->load->view('client/check_out', $data);
    }

    public function cancel_application($id){
        $this->application->delete($id);
        $this->session->set_flashdata('success', 'Your application has beed cancel!');
        redirect('/');
    }
 
}