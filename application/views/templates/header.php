<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$is_login = $this->session->userdata('user_id');
$fullname = $this->session->userdata('fullname');
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <!-- <script src="/assets/js/App.js"></script> -->
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="top-nav navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Iselco Uno</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
<?php                   if(!$is_login){
?>                        <li class="nav-item"><a class="nav-link" href="#applicationForm">Apply Online</a></li>
<?php
                        }
                        else{
?>                        <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#status">Application Status</a></li>
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
       