<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends CI_Model {

    public function validate_application() 
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

    public function validate_add_prod(){
        $this->form_validation->set_error_delimiters('<div class="alert text-danger">','</div>');
        $this->form_validation->set_rules('blk', 'Street Blks', 'required');
        $this->form_validation->set_rules('baranggay', 'Baranggay', 'required');   
        $this->form_validation->set_rules('city', 'City', 'required');     
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else {
            return 'success';
        }   
    }


    public function create_new($form_data)
    { 
        $query = "INSERT INTO applications (product_id, qty, blk, baranggay, city, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['prod_id']), 
            $this->security->xss_clean($form_data['qty']), 
            $this->security->xss_clean($form_data['blk']), 
            $this->security->xss_clean($form_data['baranggay']), 
            $this->security->xss_clean($form_data["city"]),
            $this->security->xss_clean($form_data["user_id"]),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean(date("Y-m-d H:i:s")));
        return $this->db->query($query, $values);
    }

    public function cancel_app($id){
        $status = '3';
        return $this->db->query("UPDATE applications SET status = ?,  updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($status),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean($id)));
    }
    
    public function steps_update($form_data){
        $status = '1';
        return $this->db->query("UPDATE applications SET status = ?, step =?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($form_data['new_step']),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean($form_data['app_id'])));
    }

    public function success(){
        $app_id = $this->session->userdata('app_id');
        $prod_id = $this->session->userdata('prod_id');
        $mop = $this->session->userdata('mop');
        $id = $this->session->userdata('user_id');
        $query = "INSERT INTO transactions (application_id, product_id, mode_of_payment, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?)";
        $values = array( 
            $this->security->xss_clean($app_id), 
            $this->security->xss_clean($prod_id), 
            $this->security->xss_clean($mop),
            $this->security->xss_clean($id),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean(date("Y-m-d H:i:s")));
        return $this->db->query($query, $values);
    }

    public function counter($form_data, $filename){
        // echo('process counter');
        $id = $this->session->userdata('user_id');
        $query = "INSERT INTO transactions (application_id, product_id, mode_of_payment, proof, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
        $values = array( 
            $this->security->xss_clean($form_data['app_id']), 
            $this->security->xss_clean($form_data['prod_id']), 
            $this->security->xss_clean($form_data['mop']),
            $this->security->xss_clean($filename),
            $this->security->xss_clean($id),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean(date("Y-m-d H:i:s")));
        return $this->db->query($query, $values);
    }

    public function paid(){
        $app_id = $this->session->userdata('app_id');
        $status = '1.1';
        return $this->db->query("UPDATE applications SET status = ?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($status),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean($app_id)));
    }

    public function counter_paid($form_data){
        $status = '1.1';
        return $this->db->query("UPDATE applications SET status = ?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($status),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean($form_data['app_id'])));
    }

}