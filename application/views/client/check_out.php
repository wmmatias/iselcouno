<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$new_total = $details['qty'] * $details['amount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- PLUGINS CSS STYLE -->
    <link href="/assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
    <link href="/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
    <!-- No Extra plugin used -->
    <link href='/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css' rel='stylesheet'>
    <link href='/assets/plugins/daterangepicker/daterangepicker.css' rel='stylesheet'>
    <link href='/assets/plugins/toastr/toastr.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/admin/css/custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css">
    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="/assets/css/sleek.css" />
    <script src="/assets/plugins/nprogress/nprogress.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="/assets/js/App.js"></script>
</head>
<body>
	
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
                        <h2><small><a href="/">Home</a></small> | <strong>Check Out</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 border-end">
                                <h5>Product Details</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="img-fluid" src="/assets/images/upload/<?=$details['image']?>" alt="<?=$details['name']?>" style="width:200px">
                                    </div>
                                    <div class="col-md-8">
                                    <form action="/payments/create" method="post">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                        <div class="row">
                                            <div class="col-md mb-3">
                                                <label for="name">Name:</label>
                                                <input type="text" class="form-control" name="name" value="<?=$details['name']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control" id="description" rows="4" readonly><?=$details['description']?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md mb-3">
                                                <label for="qty">Quantity</label>
                                                <input type="qty" class="form-control" id="qty" name="qty" value="<?=$details['qty']?>" readonly>
                                            </div>
                                            <div class="col-md mb-3">
                                                <label for="amount">Amount</label>
                                                <input type="text" class="form-control" value="<?= number_format($details['amount'],2)?>" readonly>
                                                <input type="hidden" class="form-control" id="amount" name="amount" value="<?=$details['amount']?>" readonly>
                                                <input type="hidden" class="form-control" id="prod_id" name="prod_id" value="<?=$details['prod_id']?>" readonly>
                                                <input type="hidden" class="form-control" id="app_id" name="app_id" value="<?=$details['id']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <h3 class="text-dark">Total:</h3>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <input type="total_amount" class="form-control" id="total_amount" name="total_amount"  value="<?= number_format($new_total,2)?>"readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <a href="/clients/cancel_application/<?=$details['id']?>" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to CANCEL this application?')">Cancel Application</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Payment Method</h5>
                                <hr>
                                <div class="col-md m-4">
                                    <button class="btn btn-primary w-100 p-5" type="submit" style="font-size: 2rem;"><i class="mdi mdi-credit-card"></i> Debit / Credit</button>
                                </div>
                                </form>
                                <div class="col-md m-4">
                                    <h5 class="mb-2">Please Upload your Reference# here: <small><a href="#" data-toggle="modal" data-target="#qr">Scan QRCode Here <i class="mdi mdi-qrcode-scan"></i></a></small></h5>
                                    <form action="/payments/gcash/<?=$details['id']?>" method="post">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                        <div class="col mb-3">
                                            <input type="hidden" class="form-control" id="prod_id" name="prod_id" value="<?=$details['prod_id']?>">
                                            <input type="hidden" class="form-control" id="app_id" name="app_id" value="<?=$details['id']?>" >
                                            <input type="hidden" class="form-control" id="mop" name="mop" value="3">
                                            <input type="text" class="form-control" id="reference" name="reference" minlength="5" placeholder="Reference Number">
                                            <?php echo form_error('reference') ?>
                                            <?php echo($this->session->userdata('gcash_error')) ?>

                                        </div>
                                        <div class="col mt-3">
                                            <button class="btn btn-primary w-100 p-3" type="submit"  style="font-size: 2rem;">Gcash</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md m-4 p-5 border">
                                    <h5 class="mb-2">Please Upload your Proof of payment here: <small>(.jpg, .jpeg, .png)</small></h5>
                                    <form action="/payments/counter/<?=$details['id']?>" method="post"  enctype="multipart/form-data">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                        <div class="col mb-3">
                                            <input type="hidden" class="form-control" id="prod_id" name="prod_id" value="<?=$details['prod_id']?>">
                                            <input type="hidden" class="form-control" id="app_id" name="app_id" value="<?=$details['id']?>" >
                                            <input type="hidden" class="form-control" id="mop" name="mop" value="2">
                                            <input type="file" class="form-control" id="proof" name="proof">
                                            <?php echo form_error('proof') ?>
                                            <?php if(isset($error)) { echo $error; }?>

                                        </div>
                                        <div class="col mt-3">
                                            <button class="btn btn-success w-100 p-5" type="submit"  style="font-size: 2rem;">Over the Counter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>

        
<!-- Modal -->
<div class="modal fade" id="qr" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Gcash QR-Code</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body text-center">
				<img class="img-fluid" src="/assets/images/qrcode.jpg" style="width:400px;" alt="qrcode">
			</div>
		</div>
	</div>
</div>
       

    
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/plugins/simplebar/simplebar.min.js"></script>
    <script src='/assets/plugins/charts/Chart.min.js'></script>
    <script src='/assets/js/chart.js'></script>
    <script src='/assets/plugins/daterangepicker/moment.min.js'></script>
    <script src='/assets/plugins/daterangepicker/daterangepicker.js'></script>
    <script src='/assets/js/date-range.js'></script>
    <script src='/assets/plugins/toastr/toastr.min.js'></script>
    <script src="/assets/js/sleek.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
</body>
</html>