<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                        <h2><strong>User List</strong></h2>
                        <a href="/dashboards/add_user" class="btn btn-primary" id="btn-right" tabindex="0" data-toggle="tooltip" data-original-title="Add User" data-placement="left"><i class="mdi mdi-account-multiple-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="hoverable-data-table">
                            <div id="hoverable-data-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <table id="datatable" class="table table-hover nowrap dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="hoverable-data-table_info">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>User Level</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                           foreach($datas as $data){
                                $create = date('m-d-Y', strtotime($data['created_at']));
    ?>                                    <tr>
                                            <td><?= $data['first_name'].' '.$data['last_name']?></td>
                                            <td><?= $data['email']?></td>
                                            <td><?= ($data['user_level'] === '0' ? 'Admin' : 'User')?></td>
                                            <td><?= ($data['status'] === '0' ? 'Not Verified' : 'Verified')?></td>
                                            <td><?= $create?></td>
                                            <td>
                                                <a href="/dashboards/delete/<?=$data['id']?>" onclick="return confirm('Are you sure you want to DELETE this?')" class="text-xxsm btn btn-danger" tabindex="0" data-toggle="tooltip" data-original-title="Delete" data-placement="left"><i class="mdi mdi-delete-forever"></i></a>
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