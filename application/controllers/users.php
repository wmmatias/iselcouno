<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    /*  DOCU: This function is triggered by default which displays the sign in/dashboard.
        Owner: Wilard
    */
    public function index() 
    {   
        $current_user_id = $this->session->userdata('user_id');
        if(!$current_user_id) { 
            $this->load->view('templates/header');
            $this->load->view('users/signin');
        } 
        else {
            redirect("dashboard");
        }
    }
    
    /*  DOCU: This function is triggered to display sign in page if there's no user session yet
        Owner: Wilard
    */
    public function signin() 
    {
        $current_user_id = $this->session->userdata('user_id');
        
        if(!$current_user_id) { 
            $this->load->view('templates/header');
            $this->load->view('users/signin');
        } 
        else {
            redirect("dashboard");
        }
    }

    // /*  DOCU: This function is triggered to display registration page if there's no user session yet.
    //     Owner: Wilard
    // */
    public function register() 
    {
        $current_user_id = $this->session->userdata('user_id');
        if(!$current_user_id) { 
            $this->load->view('templates/header');
            $this->load->view('users/register');
        } 
        else {
            redirect("dashboard");
        }
    }

    /*  DOCU: This function logs out the current user then goes to sign in page.
        Owner: Wilard
    */
    public function logoff() 
    {
        $this->session->sess_destroy();
        redirect("/");   
    }
    
    /*  DOCU: This function is triggered when the sign in button is clicked. 
        This validates the required form inputs and if user password matches in the database by given email.
        If no problem occured, user will be routed to the dashboard.
        Owner: Wilard
    */
    public function process_signin() 
    {
        $result = $this->user->validate_signin_form();
        if($result != 'success') {
            $this->session->set_flashdata('input_errors', $result);
            redirect("signin");
        } 
        else 
        {
            $email = $this->input->post('email');
            $user = $this->user->get_user_by_email($email);
            
            $result = $this->user->validate_signin_match($user, $this->input->post('password'));
            
            if($result == "success") 
            {   
                $is_admin = $this->user->validate_is_admin($email);
                if(!empty($is_admin)){
                    $this->session->set_userdata(array('user_id'=>$user['id'], 'auth' => true));
                    redirect("dashboard");
                }
                else{
                    $this->session->set_userdata(array('user_id'=>$user['id']));
                    redirect("dashboard");
                }
            }
            else 
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect("signin");
            }
        }

    }
    
    // /*  DOCU: This function is triggered when the register button is clicked. 
    //     This validates the required form inputs then checks if the email is already taken. 
    //     If no problem occured, user information will be stored in database 
    //     and said user will be routed to the dashboard.
    //     Owner: Wilard
    // */
    public function process_registration() 
    {   
        $email = $this->input->post('email');
        $result = $this->user->validate_registration($email);
        if($result!=null)
        {
            $this->session->set_flashdata('input_errors', $result);
            redirect("register");
        }
        else
        {
            $form_data = $this->input->post();
            $this->user->create_user($form_data);

            $new_user = $this->user->get_user_by_email($form_data['email']);
            $this->session->set_userdata(array('user_id' => $new_user["id"], 'first_name'=>$new_user['first_name']));
            
            redirect("dashboard");
        }
    }

    /*  DOCU: This function loads the details of current user in profile page.
        Owner: Wilard
    */
    public function profile() 
    {   
        $user_id = $this->session->user_id;
        $user = $this->user->get_user_id($user_id);
        $details = array('details'=>$user);
        $this->load->view('templates/header');
        $this->load->view('users/edit',$details); 
    }

    /*  DOCU: This function validate the user information.
        Owner: Wilard
    */
    public function edit_information_process() 
    {   
        $result = $this->user->validate_information();
        if($result != 'success') {
            $this->session->set_flashdata('input_errors', $result);
            redirect("users/edit");
        } 
        else
        {
            $form_data = $this->input->post();
            $this->user->update_userinformation($form_data);
            $this->session->set_flashdata('success','The user information successfully modified');
            redirect("users/edit");
        }
    }
    
    /*  DOCU: This function validate the user credentials input.
        Owner: Wilard
    */
    public function edit_credentials() 
    {   
        $this->output->enable_profiler(TRUE);
        $checkpassword = $this->input->post();
        $result = $this->user->validate_change_password($checkpassword);
        if(!empty($result)) {
            $this->session->set_flashdata('credentials_errors', $result);
            redirect("users/edit");
        } 
        else
        {  
            $form_data = $this->input->post();
            $this->user->update_credentials($form_data);
            $this->session->set_flashdata('successc','your credential successfully update');
            redirect("users/edit");
        }
    }
    
}
