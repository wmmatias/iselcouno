<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    public function get_user_by_email($email)
    { 
        $query = "SELECT * FROM users WHERE email=?";
        return $this->db->query($query, $this->security->xss_clean($email))->result_array()[0];
    }

    public function get_details_by_email($email)
    { 
        $query = "SELECT id, first_name, last_name, blk, baranggay, city FROM users WHERE email=?";
        return $this->db->query($query, $this->security->xss_clean($email))->result_array();
    }

    public function check_mail($form_data)
    { 
        $query = "SELECT email FROM users WHERE email=?";
        return $this->db->query($query, $this->security->xss_clean($form_data['email']))->result_array();
    }

    public function is_verified($email)
    { 
        $query = "SELECT status FROM users WHERE email=? and status = '1'";
        return $this->db->query($query, $this->security->xss_clean($email))->result_array()[0];
    }

    public function resend_details($id)
    { 
        $query = "SELECT first_name, last_name, email, vkey FROM users WHERE id=? LIMIT 1";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array();
    }

    public function create_validation($form_data)
    {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('status', 'Status', 'required');

        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
        else if(!empty($this->check_mail($form_data))){
            $this->session->set_flashdata('error', 'Email Already in use');
            return 'Email Already in use';
        }
    }

    function get_user_applicant($form_data)
    { 
        return $this->db->query("SELECT id FROM users WHERE first_name=? AND last_name=? AND phone=? ORDER BY id DESC LIMIT 1", 
        array(
            $this->security->xss_clean($form_data['firstname']),
            $this->security->xss_clean($form_data['lastname']),
            $this->security->xss_clean($form_data['phone'])
        ))->row_array(); 
    }

    public function create_user($user)
    {
        $status = '0';
        $password = 'Iselco@2022';
        $vkey = md5(time().$user['firstname']);

        $query = "INSERT INTO users (first_name, last_name, phone, email, password, user_level, vkey, status, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($user['firstname']), 
            $this->security->xss_clean($user['lastname']), 
            $this->security->xss_clean($user['phone']), 
            $this->security->xss_clean($user['email']), 
            md5($this->security->xss_clean($password)),
            $this->security->xss_clean($user['userlevel']), 
            $this->security->xss_clean($vkey), 
            $this->security->xss_clean($status), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))
        ); 
        $this->email->creation_email($user, $vkey);
        return $this->db->query($query, $values);
    }

    
    public function create_user_applicant($user)
    {
        $password = 'Iselco@2022';
        $vkey = md5(time().$user['firstname']);

        $query = "INSERT INTO users (first_name, last_name, phone, email, blk, baranggay, city, password, vkey, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($user['firstname']), 
            $this->security->xss_clean($user['lastname']), 
            $this->security->xss_clean($user['phone']), 
            $this->security->xss_clean($user['email']), 
            $this->security->xss_clean($user['street']), 
            $this->security->xss_clean($user['baranggay']), 
            $this->security->xss_clean($user['city']), 
            md5($this->security->xss_clean($password)),
            $this->security->xss_clean($vkey), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))
        ); 
        $this->email->creation_email($user, $vkey);
        return $this->db->query($query, $values);
    }

    public function validate_signin_form() {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
        else {
            return "success";
        }
    }
    
    public function validate_signin_match($user, $password) 
    {
        $hash_password = md5($this->security->xss_clean($password));

        if($user && $user['password'] == $hash_password) {
            return "success";
        }
        else {
            return "Incorrect email/password.";
        }
    }
    public function validate_is_admin($email) 
    {
        $query = "SELECT user_level FROM users WHERE email=? and user_level = '0'";
        return $this->db->query($query, $this->security->xss_clean($email))->result_array()[0];
    }

    public function get_user_id($id)
    {
        $query = "SELECT * FROM users WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    public function validate_information() 
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha');   
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else{
            return 'success';
        }
    }

    public function update_userinformation($form_data) 
    {
        return $this->db->query("UPDATE users SET first_name = ?, last_name = ?, email = ?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($form_data['first_name']), 
            $this->security->xss_clean($form_data['last_name']),
            $this->security->xss_clean($form_data['email']), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($form_data['id'])));
    }

    public function validate_change_password($password = null) 
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
        $this->form_validation->set_rules('current', 'Old Password', 'required');
        $this->form_validation->set_rules('new', 'Password', 'required|min_length[8]');   
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[new]');  
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if(empty($this->check_password($password))){
            $this->session->set_flashdata('old_pass', 'incorrect old password');
            return 'old password not matched';
        }
    }

    public function check_password($password){
         return $this->db->query("SELECT password FROM users WHERE id=? and password = ?", 
        array(
            $this->security->xss_clean($password['id']),
            md5($this->security->xss_clean($password['current']))))->row_array(); 
    }

    public function update_credentials($form_data) 
    {
        return $this->db->query("UPDATE users SET password = ?, updated_at = ? WHERE id = ?", 
        array(
            md5($this->security->xss_clean($form_data['new'])), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($form_data['id'])));
    }

    
    public function verify($vkey) 
    {
        $status = '1';
        return $this->db->query("UPDATE users SET status = ?, updated_at = ? WHERE vkey = ?", 
        array(
            $this->security->xss_clean($status), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($vkey),
            
        ));
    }

    public function checkrules(){
        $this->form_validation->set_error_delimiters('<div id="error">','</div>');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else{
            return 'success';
        }
       
    }

    public function update_user_details($form_data) 
    {
        $this->db->query("UPDATE users SET first_name = ?, last_name = ?, phone = ?, email = ?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($form_data['firstname']),
            $this->security->xss_clean($form_data['lastname']),
            $this->security->xss_clean($form_data['phone']),
            $this->security->xss_clean($form_data['email']),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($form_data['id'])));

        return $this->dashboard->get_info($form_data['id']);
    }

    public function delete_user_id($id) {
        return $this->db->query("DELETE FROM users WHERE id = ?", 
        array(
            $this->security->xss_clean($id)));
    }

    public function get_city($id){
        return $this->db->query("SELECT * FROM cities WHERE id=?",
        array(
            $this->security->xss_clean($id)
        ))->result_array()[0];
    }

    public function get_brgy($id){
        return $this->db->query("SELECT * FROM barangays WHERE id=?",
        array(
            $this->security->xss_clean($id)
        ))->result_array()[0];
    }

}

?>