<?php
defined('BASEPATH') OR exit('No direct script access allowed');
var_dump($_SESSION)
?>

	
<div class="content-wrapper">
    <div class="content">
        <div class="row">
			<div class="col-xl-12 col-md-12">
                <!-- Sales Graph -->
                <div class="card card-default">
                    
                  <?=$this->session->flashdata('input_errors');?>
                    <div class="card-header card-header-border-bottom">
                        <h2><strong>Add User</strong></h2>
                        <a href="/dashboards/user_list" class="btn btn-primary" id="btn-right" tabindex="0" data-toggle="tooltip" data-original-title="User List" data-placement="left"><i class="mdi mdi-format-list-bulleted"></i></a>
                    </div>
                    <div class="card-body">
                        <form action="/dashboards/add" method="post">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                        <div class="form-row">
                                <div class="col-md mb-3">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                                    <?php echo form_error('firstname') ?>
                                </div>
                                <div class="col-md mb-3">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                                    <?php echo form_error('lastname') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                                    <?php echo form_error('phone') ?>
                                </div>
                                <div class="col-md mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                                    <?=$this->session->flashdata('error');?>
                                    <?php echo form_error('email') ?>
                                </div>
                                <div class="col-md mb-3">
                                    <label for="userlevel">User Level</label>
                                    <select name="userlevel" class="form-control" required>
                                        <option value="select">--Select level--</option>
                                        <option value="0">Admin</option>
                                        <option value="1">User</option>
                                    </select>
                                    <?=$this->session->flashdata('select');?>
                                    <?php echo form_error('userlevel') ?>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Add User</button>
                        </form>
                    </div>
                </div>
			</div>
		</div>
    </div> <!-- End Content -->