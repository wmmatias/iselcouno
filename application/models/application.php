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

    public function gcash_validate() 
    {
        $this->form_validation->set_error_delimiters('<div class="alert text-danger">','</div>');
        $this->form_validation->set_rules('reference', 'Reference Number', 'required|min_length[5]');
        
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
        $query = "INSERT INTO applications (first_name, last_name, product_id, connection_type, building_type, qty, blk, baranggay, city, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['firstname']), 
            $this->security->xss_clean($form_data['lastname']),
            $this->security->xss_clean($form_data['prod_id']), 
            $this->security->xss_clean($form_data['connection']), 
            $this->security->xss_clean($form_data['building']), 
            $this->security->xss_clean($form_data['qty']), 
            $this->security->xss_clean($form_data['blk']), 
            $this->security->xss_clean($form_data['baranggay']), 
            $this->security->xss_clean($form_data["city"]),
            $this->security->xss_clean($form_data["user_id"]),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean(date("Y-m-d H:i:s")));
        $this->db->query($query, $values);
        return $this->db->insert_id();
    }

    public function requirements($app_id,$image){
        $query = "INSERT INTO requirements (application_id, name, created_at, updated_at) VALUES (?,?,?,?)";
        $values = array( 
            $this->security->xss_clean($app_id), 
            $this->security->xss_clean($image),
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
        if($form_data['new_step'] === '5'){
            $status = '2';
            return $this->db->query("UPDATE applications SET status = ?, step =?, updated_at = ? WHERE id = ?", 
            array(
                $this->security->xss_clean($status),
                $this->security->xss_clean($form_data['new_step']),
                $this->security->xss_clean(date("Y-m-d H:i:s")),
                $this->security->xss_clean($form_data['app_id'])));
        }
        else{
            $status = '1';
            return $this->db->query("UPDATE applications SET status = ?, step =?, updated_at = ? WHERE id = ?", 
            array(
                $this->security->xss_clean($status),
                $this->security->xss_clean($form_data['new_step']),
                $this->security->xss_clean(date("Y-m-d H:i:s")),
                $this->security->xss_clean($form_data['app_id'])));
        }
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
    public function gcash($form_data){
        // echo('process counter');
        $id = $this->session->userdata('user_id');
        $query = "INSERT INTO transactions (application_id, product_id, mode_of_payment, proof, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
        $values = array( 
            $this->security->xss_clean($form_data['app_id']), 
            $this->security->xss_clean($form_data['prod_id']), 
            $this->security->xss_clean($form_data['mop']),
            $this->security->xss_clean($form_data['reference']),
            $this->security->xss_clean($id),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean(date("Y-m-d H:i:s")));
        return $this->db->query($query, $values);
    }

    public function paid(){
        $app_id = $this->session->userdata('app_id');
        $status = '0.1';
        return $this->db->query("UPDATE applications SET status = ?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($status),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean($app_id)));
    }

    public function counter_paid($form_data){
        $status = '0.1';
        return $this->db->query("UPDATE applications SET status = ?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($status),
            $this->security->xss_clean(date("Y-m-d H:i:s")),
            $this->security->xss_clean($form_data['app_id'])));
    }

    public function delete($id){
        $this->db->query("DELETE FROM applications WHERE id = ?", 
        array(
            $this->security->xss_clean($id)));
        $this->db->query("DELETE FROM requirements WHERE application_id = ?", 
        array(
            $this->security->xss_clean($id)));
    }

    public function daily_chart(){ 
        $status = '1';
        return $this->db->query("SELECT applications.product_id, sum(products.amount) AS total_amount, applications.status, applications.created_at
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEAR(applications.created_at) = YEAR(NOW())
                AND MONTH(applications.created_at) = MONTH(NOW()) 
                AND DAY(applications.created_at) = DAY(NOW())
                AND applications.status = ?
                GROUP BY applications.status", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function daily_print(){ 
        $status = '1';
        return $this->db->query("SELECT applications.first_name, applications.last_name, products.name, applications.qty, products.amount * applications.qty AS total_amount, applications.status, applications.created_at
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEAR(applications.created_at) = YEAR(NOW())
                AND MONTH(applications.created_at) = MONTH(NOW()) 
                AND DAY(applications.created_at) = DAY(NOW())
                AND applications.status = ?", 
        array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function daily_total(){ 
        $status = '1';
        return $this->db->query("SELECT sum(products.amount * applications.qty) AS total_sales
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEAR(applications.created_at) = YEAR(NOW())
                AND MONTH(applications.created_at) = MONTH(NOW()) 
                AND DAY(applications.created_at) = DAY(NOW())
                AND applications.status = ?", 
        array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function ydaily_chart(){ 
        $status = '1';
        return $this->db->query("SELECT applications.product_id, sum(products.amount) AS total_amount, applications.status, applications.created_at
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEAR(applications.created_at) = YEAR(NOW())
                AND MONTH(applications.created_at) = MONTH(NOW()) 
                AND DAY(applications.created_at) = DAY(NOW() - INTERVAL 1 DAY)
                AND applications.status = ?
                GROUP BY applications.status;", 
        array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function weekly_chart(){ 
        $status = '1';
        return $this->db->query("SELECT applications.product_id, sum(products.amount) AS total_amount, applications.status, applications.created_at
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEARWEEK(applications.created_at) = YEARWEEK(NOW())  AND applications.status = ?
        GROUP BY CAST(applications.created_at AS DATE)
        ORDER BY applications.created_at ASC", 
        array(
            $this->security->xss_clean($status)
        ))->result_array();
    }
    public function weekly_print(){ 
        $status = '1';
        return $this->db->query("SELECT applications.first_name, applications.last_name, products.name, applications.qty, products.amount * applications.qty AS total_amount, applications.status, applications.created_at
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEARWEEK(applications.created_at) = YEARWEEK(NOW())
        AND applications.status = ?", 
        array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function weekly_total(){ 
        $status = '1';
        return $this->db->query("SELECT sum(products.amount * applications.qty) AS total_sales
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEARWEEK(applications.created_at) = YEARWEEK(NOW())
        AND applications.status = ?", 
        array(
            $this->security->xss_clean($status)
        ))->result_array();
    }
    
    public function monthly_chart(){ 
        $status = '1';
        return $this->db->query("SELECT applications.product_id, sum(products.amount) AS total_amount, applications.status, applications.created_at
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEAR(applications.created_at) = YEAR(NOW()) AND MONTH(applications.created_at)=MONTH(NOW()) AND applications.status = ?
        GROUP BY CAST(applications.created_at AS DATE)
        ORDER BY applications.created_at ASC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    
    public function monthly_print(){ 
        $status = '1';
        return $this->db->query("SELECT applications.first_name, applications.last_name, products.name, applications.qty, products.amount * applications.qty AS total_amount, applications.status, applications.created_at
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEAR(applications.created_at) = YEAR(NOW()) 
        AND MONTH(applications.created_at)=MONTH(NOW())
        AND applications.status = ?", 
        array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function monthly_total(){ 
        $status = '1';
        return $this->db->query("SELECT sum(products.amount * applications.qty) AS total_sales
        FROM iselcouno.applications
        LEFT JOIN iselcouno.products
        ON applications.product_id = products.id
        WHERE YEAR(applications.created_at) = YEAR(NOW()) 
        AND MONTH(applications.created_at)=MONTH(NOW())
        AND applications.status = ?", 
        array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

}