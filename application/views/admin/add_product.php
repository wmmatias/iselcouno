<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// var_dump($data)
?>

	
<div class="content-wrapper">
    <div class="content">
        <div class="row">
			<div class="col-xl-12 col-md-12">
                <!-- Sales Graph -->
                <div class="card card-default">
                    
                  <?=$this->session->flashdata('input_errors');?>
                    <div class="card-header card-header-border-bottom">
                        <h2><strong>Add Product</strong></h2>
                        <a href="/dashboards/product_list" class="btn btn-primary" id="btn-right" tabindex="0" data-toggle="tooltip" data-original-title="Product List" data-placement="left"><i class="mdi mdi-format-list-bulleted"></i></a>
                    </div>
                    <div class="card-body">
                        <form action="/dashboards/create_product" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                            <div class="form-row">
                                <div class="col-md">
                                    <div class="col-md mb-3">
                                        <label for="name">Item Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Item Name" required>
                                        <?php echo form_error('name') ?>
                                    </div>
                                    <div class="col-md mb-3">
                                        <label for="description">Item Description</label>
                                        <input type="text" class="form-control" name="description" placeholder="Item Description" required>
                                        <?php echo form_error('description') ?>
                                    </div>
                                    <div class="col-md mb-3">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" name="amount" placeholder="Amount" required>
                                        <?php echo form_error('amount') ?>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="col-md mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" placeholder="image" id="upload_file" onchange="getImagePreview(event)" accept=".jpg, .jpeg, .png" required>
                                        <?php echo form_error('image') ?>
                                        <?php if(isset($error)) { echo $error; }?>
                                    </div>
                                    <div class="col-md mb-3" id="preview"></div>
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                    <div class="col-md mb-3">
                                        <button class="btn btn-primary" type="submit">Add Product</button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
    </div> <!-- End Content -->