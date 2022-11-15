<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// var_dump($datas)
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
                        <h2><strong>Product List</strong></h2>
                        <a href="/dashboards/add_product" class="btn btn-primary" id="btn-right" tabindex="0" data-toggle="tooltip" data-original-title="Add Product" data-placement="left"><i class="mdi mdi-plus-box"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="hoverable-data-table">
                            <div id="hoverable-data-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <table id="datatable" class="table table-hover nowrap dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="hoverable-data-table_info">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                           foreach($datas as $data){
                                $create = date('m-d-Y', strtotime($data['created_at']));
        ?>                                <tr>
                                            <td><img class="product_img img-fluid" src="/assets/images/upload/<?=$data['image']?>" alt="<?=$data['image']?>"></td>
                                            <td><?= $data['name']?></td>
                                            <td><?= $data['description'] ?></td>
                                            <td><?= number_format($data['amount'],2) ?></td>
                                            <td>
                                                <!-- <a href="/dashboards/edit_product/<?=$data['id']?>" class="text-xxsm btn btn-success" tabindex="0" data-toggle="tooltip" data-original-title="Edit" data-placement="left"><i class="mdi mdi-pen"></i></a> -->
                                                <a href="/dashboards/product/<?=$data['id']?>" onclick="return confirm('Are you sure you want to DELETE this?')" class="text-xxsm btn btn-danger" tabindex="0" data-toggle="tooltip" data-original-title="Delete" data-placement="left"><i class="mdi mdi-delete-forever"></i></a>
                                            </td>
<?php                           }
?>                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </div> <!-- End Content -->