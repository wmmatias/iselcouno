<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$is_login = $this->session->userdata('user_id');
?><div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Iselco Uno</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
<?php                   if(!$is_login){
?>                        <li class="nav-item"><a class="nav-link" href="#portfolio">Apply Online</a></li>
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
                        Fullname
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