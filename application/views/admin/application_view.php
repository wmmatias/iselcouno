<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$new_step = $application_details['step'] + 1;
?>

	
<div class="content-wrapper">
    <div class="content">
<?php	if(!$this->session->flashdata('success')){
		}
		else{
?>		<div class="alert alert-dismissible fade show alert-success" role="alert">
			<?=$this->session->flashdata('success');?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
<?php	}
?>        <div class="row">
			<div class="col-xl-12 col-md-12">
                <!-- Sales Graph -->
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2><strong>Application of <?=$application_details['first_name'].' '.$application_details['last_name']?></strong></h2>
                        <a href="/dashboards/application_list" class="btn btn-primary" id="btn-right" tabindex="0" data-toggle="tooltip" data-original-title="Add Product" data-placement="left"><i class="mdi mdi-format-list-bulleted"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <!-- <?php var_dump($application_details) ?> -->
                                <h3 class="text-dark">Status:
<?php                               if($application_details['status'] === '0'){
?>                                      New Pending Payment
<?php                               }
                                    elseif($application_details['status'] === '0.1'){
?>                                      New Paid On Review
<?php                               }
                                    elseif($application_details['status'] === '1'){
?>                                      On Process
<?php                               }
                                    elseif($application_details['status'] === '2'){
?>                                      Done
<?php                               }
                                    elseif($application_details['status'] === '3'){
?>                                      Cancelled <?=date('m-d-Y',strtotime($application_details['updated_at']))?>
<?php                               }
?>                                </h3>
                            </div>
                            <div class="col-md-2 offset-md-6 mb-3">
                                <label for="date">Date Applied</label>
                                <input type="text" class="form-control" name="date" value="<?=date('m-d-Y',strtotime($application_details['created_at']))?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md mb-3">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="firstname" value="<?=$application_details['first_name']?>" readonly>
                            </div>
                            <div class="col-md mb-3">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname"  value="<?=$application_details['last_name']?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md mb-3">
                                <label for="blk">Street Blk Purok</label>
                                <input type="text" class="form-control" name="blk" value="<?=$application_details['blk']?>" readonly>
                            </div>
                            <div class="col-md mb-3">
                                <label for="lastname">Baranggay</label>
                                <input type="text" class="form-control" name="lastname"  value="<?=$brgy['name']?>" readonly>
                            </div>
                            <div class="col-md mb-3">
                                <label for="lastname">City/Municipality</label>
                                <input type="text" class="form-control" name="lastname"  value="<?=$city['name']?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md mb-3">
                                <p>Steps Done</p>
                                <hr>
                                <ul>
                                    <li>
                                        <p class="<?=($application_details['step'] >='1' ? 'text-dark' : '')?>"><i class="<?=($application_details['step'] >='1' ? 'mdi mdi-check-circle text-success' : 'mdi mdi-checkbox-blank-circle')?>"></i> Step 1: Payment<small>(Need to pay)</small></p>
                                    </li>
                                    <li>
                                        <p class="<?=($application_details['step'] >='2' ? 'text-dark' : '')?>"><i class="<?=($application_details['step'] >='2' ? 'mdi mdi-check-circle text-success' : 'mdi mdi-checkbox-blank-circle')?>"></i> Step 2: Application Evaluation & Verification</p>
                                    </li>
                                    <li>
                                        <p class="<?=($application_details['step'] >='3' ? 'text-dark' : '')?>"><i class="<?=($application_details['step'] >='3' ? 'mdi mdi-check-circle text-success' : 'mdi mdi-checkbox-blank-circle')?>"></i> Step 3: Scheduling of Inspection </p>
                                    </li>
                                    <li>
                                        <p class="<?=($application_details['step'] >='4' ? 'text-dark' : '')?>"><i class="<?=($application_details['step']  >='4' ? 'mdi mdi-check-circle text-success' : 'mdi mdi-checkbox-blank-circle')?>"></i> Step 4: Calibration and Installation</p>
                                    </li>
                                    <li>
                                        <p class="<?=($application_details['step'] >='5' ? 'text-dark' : '')?>"><i class="<?=($application_details['step']  >='5' ? 'mdi mdi-check-circle text-success' : 'mdi mdi-checkbox-blank-circle')?>"></i> Step 5: Success</p>
                                    </li>
                                </ul>
                                <form action="/dashboards/steps_update" method="post">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                    <input type="hidden" name="app_id" value="<?=$application_details['id']?>">
                                    <input type="hidden" name="new_step" value="<?=$new_step?>">
                                    <button class="btn btn-success mt-5 <?=($application_details['status'] === '3' || $new_step > 5 ? 'd-none' : '')?>">Next Step</button>
                                </form>
                            </div>
                            <div class="col-md mb-3">
                                <p>Product Details</p>
                                <hr>
                                <div class="d-inline-block align-top">
                                    <img src="/assets/images/upload/<?=$application_details['image']?>" style="width: 150px;" alt="<?=$application_details['name']?>">
                                </div>
                                <div class="d-inline-block align-top">
                                    <h2 class="text-dark"><strong><?=$application_details['name']?></strong></h2>
                                    <p class="text-dark"><?=$application_details['description']?></p>
                                    <p class="text-dark">Qty: <?=$application_details['qty']?></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <p>Requirements</p>
                                <hr>
<?php                           foreach($requirements as $data){
?>                                
                                <a class="portfolio-box" href="/assets/images/upload/requirements/<?=$data['name']?>" title="<?=$data['name']?>" target="_blank">
                                    <img class="img-fluid" src="/assets/images/upload/requirements/<?=$data['name']?>" alt="<?=$data['name']?>" style="width: 150px;"/>
                                </a>
<?php                           }
?>                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </div> <!-- End Content -->