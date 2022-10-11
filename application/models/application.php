<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends CI_Model {

    function validate_application() 
    {
        $this->form_validation->set_error_delimiters('<div class="alert text-danger">','</div>');
        $this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[2]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[2]');   
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');        
        $this->form_validation->set_rules('phone', 'phone', 'required|numeric');
        $this->form_validation->set_rules('street', 'Street', 'required');   
        $this->form_validation->set_rules('baranggay', 'Baranggay', 'required');        
        $this->form_validation->set_rules('city', 'City', 'required');
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else {
            return 'success';
        }
    }


    function create_new($form_data)
    { 
        $status = md5(time().$form_data['baranggay'].$form_data["city"]);
        $query = "INSERT INTO applications (blk, baranggay, city, status, created_at, updated_at) VALUES (?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['street']), 
            $this->security->xss_clean($form_data['baranggay']), 
            $this->security->xss_clean($form_data["city"]),
            $this->security->xss_clean($status),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean(date("Y-m-d H:i:s"))); 
        return $this->db->query($query, $values);
    }

    function get_application_id($form_data)
    { 
        return $this->db->query("SELECT id FROM applications WHERE blk=? AND baranggay=? AND city=? ORDER BY id DESC LIMIT 1", 
        array(
            $this->security->xss_clean($form_data['street']),
            $this->security->xss_clean($form_data['baranggay']),
            $this->security->xss_clean($form_data['city'])
        ))->row_array(); 
    }

}