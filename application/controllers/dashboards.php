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
            $res = $this->dashboard->select_new();
            $app = array('app'=>$res);
            $new = $this->dashboard->count_new();
            $onprocess = $this->dashboard->count_onprocess();
            $success = $this->dashboard->count_success();
            $cancel = $this->dashboard->count_cancelled();
            $res = $this->dashboard->get_info($this->session->userdata('user_id'));
            $data = array ('data' => $res, 'new'=>$new, 'onprocess'=>$onprocess, 'success'=>$success, 'cancel'=>$cancel);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar', $data);
            $this->load->view('admin/dashboard', $app);
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


    // public function update_product() 
    // {   
    //     $isadmin = $this->session->userdata('auth');
    //     if(!$isadmin){
    //         redirect('/');
    //     }
    //     else{
    //         $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
    //         $this->form_validation->set_rules('name', 'Item Name', 'required');
    //         $this->form_validation->set_rules('description', 'Description', 'required');
    //         $this->form_validation->set_rules('amount', 'amount', 'required');

    //         if($this->form_validation->run()) {
    //             $image = $_FILES['image']['name'];
    //             $new_name = time()."product".$image;
    //             $config = [
    //                 'upload_path' => './assets/images/upload',
    //                 'allowed_types' => 'jpg|jpeg|png',
    //                 'file_name' => $new_name,
    //             ];
    //             $this->upload->initialize($config);
    //             if ( ! $this->upload->do_upload('image')){
    //                 $error = array('error' => $this->upload->display_errors());
    
    //                 $this->load->view('admin/template/header');
    //                 $this->load->view('admin/template/sidebar');
    //                 $this->load->view('admin/template/topnavbar');
    //                 $this->load->view('admin/edit_product', $error);
    //                 $this->load->view('admin/template/footer');
    //             }
    //             else{
    //                 $form_data = $this->input->post();
    //                 $filename = $this->upload->data('file_name');
                    
    //                 $this->dashboard->update_product($form_data, $filename);
    //                 $this->session->set_flashdata('success', 'Successfully Created!');
    //                 redirect('dashboards/product_list');
    //             }

    //         }
    //         else{
    //             // $this->edit_product();
    //         }
    //     }
    // }

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

    public function report() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->dashboard->fetch_all_application();
            $data = array('datas' => $res);

            $dchart = $this->application->daily_chart();
            $ychart = $this->application->ydaily_chart();
            $wchart = $this->application->weekly_chart();
            $mchart = $this->application->monthly_chart();
            $chart = array('dchart'=>$dchart, 'ychart'=>$ychart, 'wchart'=>$wchart, 'mchart'=>$mchart);

            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/reports');
            $this->load->view('admin/template/footer', $chart);
        }
    }

    public function dprint() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->application->daily_print();
            $total = $this->application->daily_total();
            $data = array('daily' => $res, 'total'=>$total);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/preview_ddata', $data);
            $this->load->view('admin/template/footer');
        }
    }

    
    public function wprint() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->application->weekly_print();
            $total = $this->application->weekly_total();
            $data = array('weekly' => $res, 'total'=>$total);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/preview_wdata', $data);
            $this->load->view('admin/template/footer');
        }
    }
    
    public function mprint() 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->application->monthly_print();
            $total = $this->application->monthly_total();
            $data = array('monthly' => $res, 'total'=>$total);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/preview_mdata', $data);
            $this->load->view('admin/template/footer');
        }
    }

    
    public function cancel($id){
        $this->application->cancel_app($id);
        $this->session->set_flashdata('success', 'Successfully Cancelled!');
        $this->application_list();
    }

    public function application_view($id) 
    {   
        $isadmin = $this->session->userdata('auth');
        if(!$isadmin){
            redirect('/');
        }
        else{
            $res = $this->dashboard->fetch_application_id($id);
            $req = $this->dashboard->fetch_req($id);
            $city = $this->user->get_city($res['city']);
            $brgy = $this->user->get_brgy($res['baranggay']);
            $data = array('application_details' => $res, 'requirements'=>$req, 'city'=>$city, 'brgy'=>$brgy);
            $this->load->view('admin/template/header');
            $this->load->view('admin/template/sidebar');
            $this->load->view('admin/template/topnavbar');
            $this->load->view('admin/application_view', $data);
            $this->load->view('admin/template/footer');
        }
    }
    
    public function steps_update(){
        $form_data = $this->input->post();
        $this->application->steps_update($form_data);
        $this->session->set_flashdata('success', 'Successfully Update!');
        $this->application_view($form_data['app_id']);
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

    public function edit_product($id){
        $res = $this->dashboard->get_product_id($id);
        $data = array('products'=>$res);
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/template/topnavbar');
        $this->load->view('admin/edit_product', $data);
        $this->load->view('admin/template/footer');
    }

    public function export_backup(){
        // Load the DB utility class
         $this->load->dbutil();
         
         // Backup your entire database and assign it to a variable
         $backup = $this->dbutil->backup();
         
         // Load the file helper and write the file to your server
         $this->load->helper('file');
         write_file(VIEWPATH.'/assets/files/db_backup/iselco_'.date('dmY').'_backup.gz', $backup);
         
        //  $this->session->set_userdata('activity', 'export database backup');
        //  $this->activity->log($this->session->userdata('user_id'));
         // Load the download helper and send the file to your desktop
         $this->load->helper('download');
         force_download('iselco_'.date('dmY').'_backup.gz', $backup);
     }
 

}