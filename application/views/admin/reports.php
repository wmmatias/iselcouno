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
                        <h2><strong>Reports</strong></h2>
                    </div>
                    <div class="card-body">
                        <div class="col">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h2>Daily Sales</h2>
                                    <a href="/dashboards/dprint"><i class="mdi mdi-printer mdi-24px"></i></a>
                                </div>
                                <div class="card-body">
                                    <canvas id="linechart" class="chartjs"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h2>Weekly Sales</h2>
                                    <a href="/dashboards/wprint"><i class="mdi mdi-printer mdi-24px"></i></a>
                                </div>
                                <div class="card-body">
                                    <canvas id="weekly" class="chartjs"></canvas>
                                </div>
                            </div>
                        </div> 
                        <div class="col">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h2>Monthly Sales</h2>
                                    <a href="/dashboards/mprint"><i class="mdi mdi-printer mdi-24px"></i></a>
                                </div>
                                <div class="card-body">
                                    <canvas id="monthly" class="chartjs"></canvas>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
			</div>
		</div>
    </div> <!-- End Content -->