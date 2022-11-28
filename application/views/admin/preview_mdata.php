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
			<div class="col">
                <!-- Sales Graph -->
                <div class="card card-default">
                    <div class="card-body">
                        <div class="row">
							<div class="col">
								<img src="/assets/images/logo.png" style="width: 150px;" alt="logo">
							</div>
							<div class="col">
								<p class="float-end text-dark">Date: <?= date('M-d-Y')?></p>
							</div>
						</div>
						<h3 class="text-center m-3 text-dark">Monthly Sales Report</h3>
						<div class="row">
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th scope="col">Date</th>
										<th scope="col">Full Name</th>
										<th scope="col">Product</th>
										<th scope="col">Qty</th>
										<th scope="col">Total Amount</th>
									</tr>
								</thead>

								<tbody>
<?php								foreach($monthly as $data){
?>									<tr>
										<td><?=date('M-d-Y', strtotime($data['created_at']))?></td>
										<td class="text-dark"><?=$data['first_name'].' '.$data['last_name']?></td>
										<td class="text-dark"><?=$data['name']?></td>
										<td class="text-dark"><?=$data['qty']?></td>
										<td class="text-dark"><?=$data['total_amount']?></td>
									</tr>
<?php								}
?>								</tbody>
							</table>
							<h4 class="text-dark float-end">Total Sales: <?=number_format($total[0]['total_sales'])?></h4>
						</div>
                    </div>
                </div>
			</div>
		</div>
    </div> <!-- End Content -->