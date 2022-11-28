<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Stripe\Checkout\Session;
use \Stripe\Stripe;
class Payments extends CI_Controller {

    public function create(){
        $form_data = $this->input->post();
        $trans = array(
            'app_id'    => $form_data['app_id'],
            'prod_id'   => $form_data['prod_id'],
            'mop'       => '1'
        );
        $this->session->set_userdata($trans);

        $amount  = $this->input->post('amount') * 100;
        $qty  = $this->input->post('qty');
        Stripe::setApiKey($this->config->item('stripe_secret_key'));
        $checkout_session = Session::create([
            'line_items' => [[ 
                'price_data' => [ 
                    'product_data' => [ 
                        'name' => $this->input->post('name'),
                        'metadata' => [ 
                            "description" => $this->input->post('prod_id').' '.$this->input->post('name'), 
                            'pro_id' => $this->input->post('prod_id')
                        ] 
                    ], 
                    'unit_amount' => $amount, 
                    'currency' => 'php', 
                ], 
                'quantity' => $qty
            ]], 
            'mode' => 'payment',
            'success_url'=>base_url('payments/success'),
            'cancel_url'=>base_url('payments/cancel')
        ]);

        header("Location:".$checkout_session->url);

    }

    public function success(){
        $this->application->success();
        $this->application->paid();
        unset(
            $_SESSION['app_id'],
            $_SESSION['prod_id'],
            $_SESSION['mop']
        );
        $this->load->view('client/success');
    }

    public function cancel(){

        $this->load->view('client/cancel');
    }

    public function counter($id){
        $image = $_FILES['proof']['name'];
        $new_name = time()."prrof".$image;
        $config = [
            'upload_path' => './assets/images/upload/proof',
            'allowed_types' => 'jpg|jpeg|png',
            'file_name' => $new_name,
        ];
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('proof')){
            $error = array('error' => $this->upload->display_errors());
            $res = $this->dashboard->fetch_application_id($id);
            $data = array('details'=>$res);
            $this->load->view('client/check_out', $data, $error);
        }
        else{
            $form_data = $this->input->post();
            $filename = $this->upload->data('file_name');
            $this->application->counter($form_data, $filename);
            $this->application->counter_paid($form_data);
            $this->load->view('client/success');
        }
    }

    public function gcash($id){
        $form_data = $this->input->post();
        $res = $this->application->gcash_validate($form_data);
        if($res != 'success'){
            $this->session->set_flashdata('gcash_error', '<p class="text-danger">Please upload a valid Reference Number</p>');
            $this->load->view('client/success');
            redirect('/clients/check_out/'.$id);
        }
        else{
            $this->application->gcash($form_data);
            $this->application->counter_paid($form_data);
            $this->load->view('client/success');
        }
    }

}