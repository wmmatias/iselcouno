<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

    public function get_info($id)
    { 
        $query = "SELECT * FROM users WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    public function fetch_all_user()
    {
        $query = "SELECT id, first_name, last_name, email, user_level, status, created_at FROM users ORDER BY created_at DESC";
        return $this->db->query($query)->result_array();
    }

    public function fetch_all_product()
    {
        $query = "SELECT * FROM products ORDER BY created_at DESC";
        return $this->db->query($query)->result_array();
    }

    public function fetch_all_transaction()
    {
        $query = "SELECT * FROM transactions ORDER BY created_at DESC";
        return $this->db->query($query)->result_array();
    }

    public function fetch_all_application()
    {
        $query = "SELECT applications.id, users.first_name, users.last_name, applications.blk, applications.baranggay, applications.city, applications.status, applications.step, applications.created_at
        FROM iselcouno.applications
        LEFT JOIN iselcouno.users
        ON applications.created_by = users.id
        ORDER BY applications.created_at DESC";
        return $this->db->query($query)->result_array();
    }

    public function fetch_application_id($id)
    {
        $query = "SELECT applications.id, users.first_name, users.last_name, applications.qty, applications.blk, applications.baranggay, applications.city, applications.status, applications.step, applications.created_at, applications.updated_at, products.name, products.id as prod_id, products.description, products.amount, products.image
        FROM iselcouno.applications
        LEFT JOIN iselcouno.users
        ON applications.created_by = users.id
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE applications.id = ?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    public function delete_product_id($id) {
        return $this->db->query("DELETE FROM products WHERE id = ?", 
        array(
            $this->security->xss_clean($id)));
    }

    public function create_product($form_data, $filename)
    {
        $id = $this->session->userdata('user_id');
        $query = "INSERT INTO products (name, description, amount, image, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['name']), 
            $this->security->xss_clean($form_data['description']), 
            $this->security->xss_clean($form_data['amount']), 
            $this->security->xss_clean($filename), 
            $this->security->xss_clean($id), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))
        ); 
        return $this->db->query($query, $values);

    }

    public function fetch_req($id){
        $query = "SELECT * FROM requirements WHERE application_id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array();
    }

    public function update_product($form_data, $filename)
    {
        $id = $this->session->userdata('user_id');
        $query = "INSERT INTO products (name, description, amount, image, created_at, updated_at) VALUES (?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['name']), 
            $this->security->xss_clean($form_data['description']), 
            $this->security->xss_clean($form_data['amount']), 
            $this->security->xss_clean($filename), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))
        ); 
        return $this->db->query($query, $values);

    }

    public function get_product_id($id){
        $query = "SELECT * FROM products WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    public function select_new(){
        $status = '0';
        $query = "SELECT applications.id, users.first_name, users.last_name, applications.blk, applications.baranggay, applications.city, applications.status, applications.step, applications.created_at
        FROM iselcouno.applications
        LEFT JOIN iselcouno.users
        ON applications.created_by = users.id
        WHERE applications.status = ?
        ORDER BY applications.created_at DESC";
        return $this->db->query($query, $this->security->xss_clean($status))->result_array();
    }

    public function count_new(){
        $status = '0';
        $query = "SELECT count(*) as new FROM applications WHERE status=?";
        return $this->db->query($query, $this->security->xss_clean($status))->result_array()[0];
    }
    
    public function count_onprocess(){
        $status = '1';
        $query = "SELECT count(*) as on_process FROM applications WHERE status=?";
        return $this->db->query($query, $this->security->xss_clean($status))->result_array()[0];
    }

    public function count_success(){
        $status = '2';
        $query = "SELECT count(*) as success FROM applications WHERE status=?";
        return $this->db->query($query, $this->security->xss_clean($status))->result_array()[0];
    }
    
    public function count_cancelled(){
        $status = '3';
        $query = "SELECT count(*) as cancel FROM applications WHERE status=?";
        return $this->db->query($query, $this->security->xss_clean($status))->result_array()[0];
    }


}
?>