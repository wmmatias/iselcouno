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
            $details = $this->user->get_details_by_email($email);
            $fullname = $user['first_name'] . ' ' . $user['last_name'];
            $status = $user['status'];

            $verified = $this->user->is_verified($email);
            if(!empty($verified)){
                $result = $this->user->validate_signin_match($user, $this->input->post('password'));
                if($result == "success") 
                {   
                    $is_admin = $this->user->validate_is_admin($email);
                    if(!empty($is_admin)){
                        $this->session->set_flashdata('success', '<strong>Successfully!</strong> logged in!');
                        $this->session->set_userdata(array('user_id'=>$user['id'], 'fullname'=>$fullname, 'status'=> $status, 'auth' => true));
                        redirect("dashboards");
                    }
                    else{
                        $this->session->set_flashdata('success', '<strong>Successfully!</strong> logged in!');
                        $this->session->set_userdata(array('user_id'=>$user['id'], 'fullname'=>$fullname, 'details'=>$details, 'status'=> $status));
                        redirect("clients");
                    }
                }
                else 
                {
                    $this->session->set_flashdata('input_errors', $result);
                    redirect("/");
                }

            }
            else{
                $this->session->set_flashdata('input_errors', 'Please verify your email then');
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
            // $exist = $this->application->get_application_id( $form_data);
            
            $check_email = $this->user->check_mail($form_data);
            if(!$check_email){
                $this->user->create_user_applicant($form_data);
                // $id = $this->user->get_user_applicant($form_data);
                // $app_id = $this->client->get_application($id);
                // $this->client->first_timeline($app_id);
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
    }

    public function verify($vkey) 
    {   
        $result = $this->user->verify($vkey);
        $this->session->set_flashdata('success', 'your email has been verified use the credential in your email to loged in!');
        redirect('/');
    }
    
    public function users_modification()
    {   
        $form_data = $this->input->post();
        $res = $this->user->checkrules();
        if($res !== 'success'){
            $this->session->set_flashdata('input_errors', $res);
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res);
            $this->load->view("partials/profile", $data);
        }
        else{
            $this->session->set_flashdata('success', 'Successfully Update!');
            $this->user->update_user_details($form_data);
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res);
            $this->load->view("partials/profile", $data);
        }
    }

    public function credentials_modification()
    {   
        $form_data = $this->input->post();
        $res = $this->user->validate_change_password($form_data);
        if(!empty($res)){
            $this->session->set_flashdata('input_errors', $res);
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res);
            $this->load->view("partials/profile", $data);
        }
        else{
            $this->user->update_credentials($form_data);
            $this->session->set_flashdata('success', 'Successfully Update!');
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res);
            $this->load->view("partials/profile", $data);
        }
    }
    
}
