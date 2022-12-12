<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
            <div class="content">
                  <!-- Top Statistics -->
                  <div class="row">
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h1 class="mb-1 text-dark"><?=number_format($new['new'])?></h1>
                          <p>New Application</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini  mb-4">
                        <div class="card-body">
                          <h1 class="mb-1 text-dark"><?=number_format($cancel['cancel'])?></h1>
                          <p>Cancelled Application</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h1 class="mb-1 text-dark"><?=number_format($onprocess['on_process'])?></h1>
                          <p>On Process Application</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h1 class="mb-1 text-dark"><?=number_format($success['success'])?></h1>
                          <p>Success Application</p>
                        </div>
                      </div>
                    </div>
                  </div>
		<div class="row">
			<div class="col-xl-12 col-md-12">
				<div class="card card-default">
				<div class="card-header">
					<h2>New Applicant</h2>
				</div>
				<div class="card-body">
				<div class="hoverable-data-table">
                            <div id="hoverable-data-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <table id="datatable" class="table table-hover nowrap dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="hoverable-data-table_info">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                           foreach($app as $data){
                                $create = date('m-d-Y', strtotime($data['created_at']));
    ?>                                <tr>
                                        <td><?=$data['id']?></td>
                                        <td><?= $data['first_name'].' '.$data['last_name']?></td>
                                        <td><?= $data['blk'].' '.$data['brgy'].' '.$data['city']?></td>
                                        <td>
<?php                                       if($data['status'] === '0'  || $data['status'] === '0.1'){
?>                                             New Pending Payment
<?php                                           if($data['step'] === '1' && $data['status'] === '0'){
?>                                                  <p class="badge bg-info <?=($data['status'] === '0' ? '':'d-none')?>">To Pay</p>    
<?php                                           }  
                                                else if($data['step'] === '1' && $data['status'] === '0.1'){     
?>                                                  <p class="badge bg-success <?=($data['status'] === '0.1' ? '':'d-none')?>">Paid</p>
<?php                                           }
                                            }
                                            elseif($data['status'] === '1'){
?>                                              On Process 
<?php                                            }
                                            elseif($data['status'] === '2'){
?>                                              Done
<?php                                       }
                                            elseif($data['status'] === '3'){
?>                                              Cancelled
<?php                                       }
?>                                        </td>
                                        <td><?= $create?></td>
                                        <td>
                                            <a href="/dashboards/view/<?=$data['id']?>" class="text-xxsm btn btn-primary" tabindex="0" data-toggle="tooltip" data-original-title="view" data-placement="left"><i class="mdi mdi-eye"></i></a>
                                            <a href="/dashboards/cancel/<?=$data['id']?>" onclick="return confirm('Are you sure you want to CANCEL this?')" class="text-xxsm btn btn-danger <?=($data['step'] >= 3 ? 'd-none' : '')?>" tabindex="0" data-toggle="tooltip" data-original-title="cancel" data-placement="left"><i class="mdi mdi-cancel"></i></a>
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