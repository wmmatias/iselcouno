<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$error = $this->session->flashdata('input_errors');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
  
    <!-- theme meta -->
    <meta name="theme-name" content="sleek" />
    <title>Iselco-Uno | Dashboard</title>
    <!-- GOOGLE FONTS -->
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="/assets/css/sleek.css" />
    <script src="/assets/plugins/nprogress/nprogress.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        // function callToaster(positionClass) {
        //   var name = "<?php echo $this->session->userdata('fullname');?>";
        //   // if(name == "NaN") name = 0;
        //   if (document.getElementById("toaster")) {
        //     toastr.options = {
        //       closeButton: true,
        //       debug: false,
        //       newestOnTop: false,
        //       progressBar: true,
        //       positionClass: positionClass,
        //       preventDuplicates: false,
        //       onclick: null,
        //       showDuration: "300",
        //       hideDuration: "1000",
        //       timeOut: "5000",
        //       extendedTimeOut: "1000",
        //       showEasing: "swing",
        //       hideEasing: "linear",
        //       showMethod: "fadeIn",
        //       hideMethod: "fadeOut"
        //     };
        //     toastr.success("Welcome to dashboard", name+"!" );
        //   }
        // }
        function getImagePreview(event){
          var image=URL.createObjectURL(event.target.files[0]);
          var imagediv= document.getElementById('preview');
          var newimg=document.createElement('img');
          imagediv.innerHTML='';
          newimg.src=image;
          newimg.width="150";
          imagediv.appendChild(newimg);
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="/assets/js/App.js"></script>
  </head>

  <body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
  <div id="toaster"></div>
    <div class="wrapper">