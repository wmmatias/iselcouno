<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Client extends CI_Model {

    public function get_info($id)
    { 
        $query = "SELECT * FROM users WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    public function get_application($id)
    {
        $query = "SELECT id FROM applications WHERE created_by=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array();
    }

    public function get_application_details($id)
    {
        $query = "SELECT * FROM applications WHERE created_by = ?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array();
    }

    public function get_application_details_by_id($id)
    {
        $query = "SELECT * FROM applications WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array();
    }

    public function get_product_details_by_id($id)
    {
        $query = "SELECT * FROM products WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array();
    }
    
    public function get_application_status($id)
    {
        $query = "SELECT id FROM applications WHERE created_by=? AND status = '0'";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    // public function get_timeline($id)
    // {
        // $query = "SELECT  applications.id, timelines.title, timelines.description, timelines.step as time_step, applications.step as app_step, applications.status, timelines.created_at
        // FROM iselcouno.timelines
        // LEFT JOIN iselcouno.applications
        // ON timelines.application_id = applications.id
        // WHERE applications.id = ?
        // ORDER BY timelines.step ASC";
    //     return $this->db->query($query, $id)->result_array();
    // }

    // public function first_timeline($id)
    // {
    //     $title = 'Application';
    //     $desc = 'Verify your account then apply for a product you want then your application is subject for evaluation';
    //     $query = "INSERT INTO timelines (application_id, title, description, created_at, updated_at) VALUES (?,?,?,?,?)";
    //     $values = array(
    //         $id,
    //         $this->security->xss_clean($title),
    //         $this->security->xss_clean($desc),
    //         $this->security->xss_clean(date("Y-m-d H:i:s")),
    //         $this->security->xss_clean(date("Y-m-d H:i:s"))); 
    //     return $this->db->query($query, $values);
    // }

}