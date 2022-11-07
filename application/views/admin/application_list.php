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
                        <h2><strong>Application List</strong></h2>
                    </div>
                    <div class="card-body">
                        <div class="hoverable-data-table">
                            <div id="hoverable-data-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <table id="datatable" class="table table-hover nowrap dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="hoverable-data-table_info">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                           foreach($datas as $data){
                                $create = date('m-d-Y', strtotime($data['created_at']));
    ?>                                <tr>
                                        <td><?= $data['first_name'].' '.$data['last_name']?></td>
                                        <td><?= $data['blk'].' '.$data['baranggay'].' '.$data['city']?></td>
                                        <td><?= ($data['status'] === '0' ? 'New' : 'On Process')?></td>
                                        <td><?= $create?></td>
                                        <td>
                                            <a href="/dashboards/delete/<?=$data['id']?>" class="text-xxsm btn btn-primary" tabindex="0" data-toggle="tooltip" data-original-title="view" data-placement="left"><i class="mdi mdi-eye"></i></a>
                                            <a href="/dashboards/delete/<?=$data['id']?>" onclick="return confirm('Are you sure you want to CANCEL this?')" class="text-xxsm btn btn-danger" tabindex="0" data-toggle="tooltip" data-original-title="cancel" data-placement="left"><i class="mdi mdi-cancel"></i></a>
                                        </td>
<?php                           }
?>                                    </tr>
                            </tbody>
                        </table>
                            </div>
                    </div>
                    </div>
                </div>
			</div>
		</div>
    </div> <!-- End Content -->