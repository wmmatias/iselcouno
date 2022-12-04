<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$is_login = $this->session->userdata('user_id');
$fullname = $this->session->userdata('fullname');
$status = $this->session->userdata('status');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Iselco-I | Meter Online Application</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/assets/css/styles.css" rel="stylesheet" />
        <link href="/assets/css/custom.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="/assets/js/Client.js"></script>
        
<script type="text/javascript">
    function showProject(id)
    {
        $("#body-timeline").html("");
        let url = "/dashboards/application_show/" + id +"";
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                let details = response[0];
                data = [
                    {
                        id: 1,
                        title: 'Payment',
                        description: 'Verify your account! pay your application! you can pay through bank or over the counter. if you wish to use bank you may pay in through pay now button in your application.'
                    },
                    {
                        id: 2,
                        title: 'Application Evaluation & Verification',
                        description: 'On going review and verify your application requirements'
                    },
                    {
                        id: 3,
                        title: 'Inspection Passed',
                        description: 'If your application passed in evaluation you are subject for inspection keep your line open and assist us in your home/establishment for inspection.'
                    },
                    {
                        id: 4,
                        title: 'Calibration and Installation',
                        description: 'Your payment has been posted, you are subject for installation just keep your line open.'
                    },
                    {
                        id: 5,
                        title: 'Success Congratulations',
                        description: 'Your meter has been installed for more service call or book us here Thank you!'
                    }
                ];
                container = document.getElementById('body-timeline');
                for(i = 0; i < data.length; i++){
                    if(data[i].id < details.step){
                        container.innerHTML+='<div class="row"><div class="col-auto text-center flex-column d-none d-sm-flex"><div class="row h-50"><div class="col">&nbsp;</div><div class="col">&nbsp;</div></div><h5 class="m-2"><span class="badge rounded-circle bg-success border-success">&nbsp;</span></h5><div class="row h-50"><div class="col border-end">&nbsp;</div><div class="col">&nbsp;</div></div></div><div class="col py-2"><div class="card-body border-success shadow bg-success text-white"><h5 class="card-title" id="title">'+ data[i].title +'</h5><p class="card-text" id="description">'+ data[i].description +'</p></div></div></div>';
                    }
                    else if(details.step === '5'){
                        container.innerHTML+='<div class="row"><div class="col-auto text-center flex-column d-none d-sm-flex"><div class="row h-50"><div class="col">&nbsp;</div><div class="col">&nbsp;</div></div><h5 class="m-2"><span class="badge rounded-circle bg-success border-success">&nbsp;</span></h5><div class="row h-50"><div class="col border-end">&nbsp;</div><div class="col">&nbsp;</div></div></div><div class="col py-2"><div class="card-body border-success shadow bg-success text-white"><h5 class="card-title" id="title">'+ data[i].title +'</h5><p class="card-text" id="description">'+ data[i].description +'</p></div></div></div>';
                    }
                    else if(data[i].id > details.step){
                        container.innerHTML+='<div class="row"><div class="col-auto text-center flex-column d-none d-sm-flex"><div class="row h-50"><div class="col">&nbsp;</div><div class="col">&nbsp;</div></div><h5 class="m-2"><span class="badge rounded-circle bg-light border">&nbsp;</span></h5><div class="row h-50"><div class="col border-end">&nbsp;</div><div class="col">&nbsp;</div></div></div><div class="col py-2"><div class="card-body border"><h5 class="card-title text-muted" id="title">'+ data[i].title +'</h5><p class="card-text text-muted" id="description">'+ data[i].description +'</p></div></div></div>';
                    }
                    else if(data[i].id = details.step){
                        container.innerHTML+='<div class="row"><div class="col-auto text-center flex-column d-none d-sm-flex"><div class="row h-50"><div class="col">&nbsp;</div><div class="col">&nbsp;</div></div><h5 class="m-2"><span class="badge rounded-circle bg-primary border-primary">&nbsp;</span></h5><div class="row h-50"><div class="col border-end">&nbsp;</div><div class="col">&nbsp;</div></div></div><div class="col py-2"><div class="card-body border-primary shadow bg-primary text-white"><h5 class="card-title" id="title">'+ data[i].title +'</h5><p class="card-text" id="description">'+ data[i].description +'</p></div></div></div>';
                    }
                }
                $("#view-modal").modal('show'); 
                 
            },
            error: function(response) {
                console.log(response)
            }
        });
    }
    function showProduct(id)
    {
        $("#product_details").html("");
        let url = "/dashboards/product_show/" + id +"";
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                console.log(response);
                let details = response[0];
                container = document.getElementById('product_details');
                container.innerHTML+='<div class="card border-0"><div class="card-body"><div class="col d-inline-block align-top"><img class="show_product img-fluid border me-2" src="/assets/images/upload/'+ details.image +'" alt=""></div><div class="col d-inline-block"><h5>'+ details.name +'</h5><p>'+ details.description +'</p><div class="form-group"><label for="qty">Qty:</label><input type="hidden" name="prod_id" class="form-control" value="'+ details.id +'"><input type="number" id="show_qty" name="qty" class="form-control" value="1" min="1" ><label for="total" id="total"><strong></strong></label></div></div></div><p><p class="d-inline-block align-top">Connection Details</p><div class="form-group"><label for="connection">Connection Type</label><select name="connection" class="form-control"><option value="1">Permanent</option><option value="2">Temporary</option></select></div><div class="form-group"><div class="form-group"><label for="image">Building Type</label><select name="building" class="form-control"><option value="1">Commercial</option><option value="2">Residential</option></select></div><div class="form-group"><label for="image">Requirements <i><small>can accept multiple file <i class="fas fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Please upload all required requirements here"></i></small></i></label><input type="file" name="files[]" class="form-control" id="image" accept=".jpg, .jpeg, .png" multiple required></div></p></div>';
                $("#apply").modal('show'); 
                 
            },
            error: function(response) {
                console.log(response)
            }
        });
    }
</script>
<script>
    $(document).ready(function(){
        $("#city").change(function(){
            var city_id = $(this).val();
            if(city_id!=""){
                $.ajax({
                    url:"<?=base_url('clients/barangay')?>",
                    method:"get",
                    data:{city_id:city_id},
                    success:function(data){
                        $("#baranggay").html(data);
                    }
                });
            }else{
                $('#baranggay').html(' <option value="">-- Select Barangay --</option>');
            }
        });
    });
</script>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="top-nav navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
                <!-- <a class="navbar-brand" href="#page-top"><img src="/assets/images/logo.jpg" style="width: 150px;" class="img-fluid" alt="logo"></a> -->
                <a class="navbar-brand" href="#page-top"><img src="/assets/images/logo2.png" style="width: 45px;" class="img-fluid" alt="logo"> Iselco Uno</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#requirements">Requirements</a></li>
<?php                   if(!$is_login){
?>                        
                        <li class="nav-item"><a class="nav-link" href="#applicationForm">Apply Online</a></li>
<?php
                        }
                        else{
?>                        <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
<!-- <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#status">Application Status</a></li> -->
<?php
                        }
?>                    </ul>
<?php                   if(!$is_login){
?>                    <a class="btn btn-primary d-inline-block align-top ms-2" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Login</a>
<?php
                        }
                        else{
?>                    <div class="dropdown">
                    <button class="btn dropdown-toggle ms-2 text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?=$fullname?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profile">Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#application">Application</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="p-2"><a class="btn btn-primary bg-primary text-white w-100" href="/users/signoff">Logout</a></li>
                    </ul>
                    </div>
<?php
                        }
?>
                </div>
            </div>
        </nav>
       
        <!-- modal application -->
        <div class="modal fade" id="application" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Applications</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-hover table-bordered">
                                <thead class="text-center bg-primary bg-gradient">
                                    <tr>
                                    <th>Application ID</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>created_at</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php                               if(empty($app)){
?>                                      <tr>
                                            <td colspan="5">Please select product</td>
                                        </tr>
<?php
                                    }
                                    foreach($app as $detail){
                                        $create = date('m-d-Y', strtotime($detail['created_at']));  
?>                                    <tr>
                                        <td><?=$detail['id']?></td>
                                        <td><?=$detail['blk'].' '.$detail['baranggay'].' '.$detail['city']?></td>
                                        <td>
<?php                                       if($detail['status'] === '0'){
?>                                              <p class="badge bg-danger">Pending</p> 
<?php                                       }
                                            elseif($detail['status'] === '1'){
?>                                              <p class="badge bg-info">On Process</p>
<?php                                       }
                                            elseif($detail['status'] === '2'){
?>                                              <p class="badge bg-success">Done</p>
<?php                                       }
                                            elseif($detail['status'] === '3'){
?>                                              <p class="badge bg-danger">Cancelled</p>
<?php                                       }
                                            if($detail['status'] === '0'){
?>                                              <p class="badge bg-warning <?=($detail['status'] === '0' ? '':'d-none')?>"> <a href="/clients/check_out/<?=$detail['id']?>">Pay Now</a></p>
<?php                                       }
                                            else if($detail['status'] === '0.1'){
?>                                              <p class="badge bg-danger">Pending</p> 
                                                <p class="badge bg-success <?=($detail['status'] != '0' ? '':'d-none')?>">Paid</p>
<?php                                       }
                                            else if($detail['status'] === '1'){
?>                                              
                                                <p class="badge bg-success <?=($detail['status'] === '1' ? '':'d-none')?>">Paid</p>
<?php                                       }
?>                                        </td>
                                        <td><?=$create?></td>
                                        <td>
                                            <!-- <form> -->
                                                <input type="hidden" value="<?=$detail['id']?>">
                                                <button class="btn btn-primary" onclick="showProject('<?=$detail['id']?>')"><i class="fas fa-eye"></i></button>
                                            <!-- </form> -->
                                        </td>
                                    </tr>
<?php                               }                            
?>                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- view record modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="view-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Application Timeline</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div id="body-timeline" class="modal-body"></div>
                </div>
            </div>
        </div>
