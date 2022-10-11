<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function logoff() 
    {
        $this->session->sess_destroy();
        redirect("/");   
    }
    
    
    public function process_signin() 
    {
        $result = $this->user->validate_signin_form();
        if($result != 'success') {
            $this->session->set_flashdata('input_errors', $result);
            redirect("/");
        } 
        else 
        {
            $email = $this->input->post('email');
            $user = $this->user->get_user_by_email($email);
            $fullname = $user['first_name'] . ' ' . $user['last_name'];
            $result = $this->user->validate_signin_match($user, $this->input->post('password'));
            
            if($result == "success") 
            {   
                $is_admin = $this->user->validate_is_admin($email);
                if(!empty($is_admin)){
                    $this->session->set_flashdata('success', '<strong>Successfully!</strong> logged in!');
                    $this->session->set_userdata(array('user_id'=>$user['id'], 'fullname'=>$fullname, 'auth' => true));
                    redirect("/");
                }
                else{
                    $this->session->set_flashdata('success', '<strong>Successfully!</strong> logged in!');
                    $this->session->set_userdata(array('user_id'=>$user['id']));
                    redirect("/");
                }
            }
            else 
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect("/");
            }
        }

    }
    
    
    public function process_application() 
    {   
        $result = $this->application->validate_application();
        if($result!= 'success')
        {
            $this->session->set_flashdata('form_error', 'Something went wrong!' . ($result != 'success' ? '': ''));
            $this->load->view('templates/header');
            $this->load->view('client/index');
            $this->load->view('templates/footer');
        }
        else
        {
            $form_data = $this->input->post();
            $exist = $this->application->get_application_id( $form_data);
            if (!$exist){
                $check_email = $this->user->check_mail($form_data['email']);
                if(!$check_email){
                    $this->application->create_new($form_data);
                    $id = $this->application->get_application_id($form_data);
                    $this->user->create_user($form_data, $id);

                    $this->email->creation_email($form_data);
                    
                    $this->session->set_flashdata('success', 'Your request has been process! check your <a href="https://mail.google.com/mail/u/0/#inbox">email</a> to validate your account');
                    $this->load->view('templates/header');
                    $this->load->view('client/index');
                    $this->load->view('templates/footer');
                }
                else{
                    $this->session->set_flashdata('form_error', 'Email already used!');
                    $this->load->view('templates/header');
                    $this->load->view('client/index');
                    $this->load->view('templates/footer');
                }
            }
            else{
                $this->session->set_flashdata('form_error', 'The address provided is already have an account please use it!');
                $this->load->view('templates/header');
                $this->load->view('client/index');
                $this->load->view('templates/footer');
            }
           
        }
    }

    
    
    
}
