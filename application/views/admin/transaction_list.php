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
                        <h2><strong>Transaction List</strong></h2>
                    </div>
                    <div class="card-body">
                        <div class="hoverable-data-table">
                            <div id="hoverable-data-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <table id="datatable" class="table table-hover nowrap dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="hoverable-data-table_info">
                                    <thead>
                                        <tr>
                                            <th>Application ID</th>
                                            <th>Mode of Payment</th>
                                            <th>Proof</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                           foreach($datas as $data){
                                $create = date('m-d-Y', strtotime($data['created_at']));
    ?>                                <tr>
                                        <td><?= $data['id']?></td>
                                        <td><?=($data['mode_of_payment'] === '1'? 'Card Payment' : ($data['mode_of_payment'] === '3'? 'Gcash' :'Over the Counter'))?></td>
                                        <td>
<?php                                       if($data['mode_of_payment'] === '1'){
?>                                              <i class="mdi mdi-credit-card"></i>
<?php                                       }
                                            else{                       
?>                                            <a href="/assets/images/upload/proof/<?=$data['proof']?>" target="_blank" title="<?=$data['proof']?>">
                                                <img class="img-fluid <?=($data['mode_of_payment'] === '3'? 'd-none' : '')?>" style="width: 50px; height:50px;" src="/assets/images/upload/proof/<?=$data['proof']?>" alt="<?=$data['proof']?>" />
                                            </a>
                                            <p class="<?=($data['mode_of_payment'] != '3'? 'd-none' : '')?>">Reference #: <?=$data['proof']?></p>
<?php                                       }
?>                                        </td>
                                        <td><?= $create?></td>
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