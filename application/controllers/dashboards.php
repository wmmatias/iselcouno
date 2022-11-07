<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends CI_Controller {

    public function index_html(){
        $res = $this->dashboard->get_info($this->session->userdata('user_id'));
        $data = array ('data' => $res);
	    $this->load->view("partials/profile", $data);
    }

    public function index() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar', $data);
            $this->load->view('admin/dashboard');
            $this->load->view('admin/template/footer');
        }
    }

    
    public function user_list() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->dashboard->fetch_all_user();
            $data = array('datas' => $res);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/user_list', $data);
            $this->load->view('admin/template/footer');
        }
    }

    public function add_user() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/add_user');
            $this->load->view('admin/template/footer');
        }
    }

    public function add_product() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/add_product');
            $this->load->view('admin/template/footer');
        }
    }

    public function add() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $form_data = $this->input->post();
            if($form_data['userlevel'] === 'select'){
                $this->session->set_flashdata('select', 'Please select level');
                $this->load->view('admin/template/header');
                $this->load->view('admin/template/sidebar');
                $this->load->view('admin/template/topnavbar');
                $this->load->view('admin/add_user');
                $this->load->view('admin/template/footer');
            }
            else{
                $res = $this->user->create_validation($form_data);
                if(!empty($res)){
                    $this->session->set_flashdata('creation_error', $res);
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/template/sidebar');
                    $this->load->view('admin/template/topnavbar');
                    $this->load->view('admin/add_user');
                    $this->load->view('admin/template/footer');
                }
                else{
                    $this->user->create_user($form_data);
                    $this->session->set_flashdata('success', 'Successfully Created!');
                    redirect('dashboards/user_list');
                }
            }
        }
    }

    public function create_product() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
            $this->form_validation->set_rules('name', 'Item Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('amount', 'amount', 'required');

            if($this->form_validation->run()) {
                $image = $_FILES['image']['name'];
                $new_name = time()."product".$image;
                $config = [
                    'upload_path' => './assets/images/upload',
                    'allowed_types' => 'jpg|jpeg|png',
                    'file_name' => $new_name,
                ];
                $this->upload->initialize($config);
                if ( ! $this->upload->do_upload('image')){
                    $error = array('error' => $this->upload->display_errors());
    
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/template/sidebar');
                    $this->load->view('admin/template/topnavbar');
                    $this->load->view('admin/add_product', $error);
                    $this->load->view('admin/template/footer');
                }
                else{
                    $form_data = $this->input->post();
                    $filename = $this->upload->data('file_name');
                    
                    $this->dashboard->create_product($form_data, $filename);
                    $this->session->set_flashdata('success', 'Successfully Created!');
                    redirect('dashboards/product_list');
                }

            }
            else{
                $this->add_product();
            }
        }
    }

    public function delete($id) 
    {  
        $this->user->delete_user_id($id);
        $this->session->set_flashdata('success', 'Successfully Deleted!');
        redirect('/dashboards/user_list');
    }

    public function delete_product($id) 
    {  
        $this->dashboard->delete_product_id($id);
        $this->session->set_flashdata('success', 'Successfully Deleted!');
        redirect('/dashboards/product_list');
    }

    public function application_list() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->dashboard->fetch_all_application();
            $data = array('datas' => $res);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/application_list', $data);
            $this->load->view('admin/template/footer');
        }
    }

    public function product_list() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->dashboard->fetch_all_product();
            $data = array('datas' => $res);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/product_list', $data);
            $this->load->view('admin/template/footer');
        }
    }

    public function transaction_list() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->dashboard->fetch_all_transaction();
            $data = array('datas' => $res);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/transaction_list', $data);
            $this->load->view('admin/template/footer');
        }
    }



}