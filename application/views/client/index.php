<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$error = $this->session->flashdata('input_errors');
$success = $this->session->flashdata('success');
$form = $this->session->flashdata('form_error');
$is_login = $this->session->userdata('user_id');
?>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
<?php                   if(!$error){

                        }
                        else{
?>
                        <div class="alert alert-danger alert-dismissible fade show" id="alerts" role="alert">
                            <?=$this->session->flashdata('input_errors');?>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Login again?</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php
                        }
?>
<?php                   if(!$success){

}
else{
?>
                        <div class="alert alert-success alert-dismissible fade show" id="alerts" role="alert">
                            <?=$this->session->flashdata('success');?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php
}
?>
<?php                   if(!$form){

}
else{
?>
                        <div class="alert alert-warning alert-dismissible fade show" id="alerts" role="alert">
                            <?=$this->session->flashdata('form_error');?>
                            <a href="#form">Back to form <i class="fas fa-arrow-down"></i></a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php
}
?>                        <h1 class="text-white font-weight-bold">A dynamic distribution Utility</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <a class="btn btn-primary btn-xl" href="#about">Read More</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Mission</h2> 
                        <p class="text-white-75 mb-4">To deliver high quality electric service responsive to the changing consumer's demand.</p> 
                        <hr class="divider divider-light" />   
                        <h2 class="text-white mt-0">Vission</h2>
                        <p class="text-white-75 mb-4">excellent power service distributor in the archipelago focused on bringing delight to our member-consumer-owners.</p>
                        <a class="btn btn-secondary btn-xl" href="#services">Get Started!</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">At Your Service</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <a class="text-decoration-none" href="https://iselcouno.com/services/billing-rates">
                            <div class="mt-5">
                                <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                                <h3 class="h4 mb-2 text-black font-weight-bold">Billing Rate</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <a class="text-decoration-none" href="#applicationForm">
                            <div class="mt-5">
                                <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                                <h3 class="h4 mb-2 text-black font-weight-bold">Electric Meter</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <a class="text-decoration-none" href="#applicationForm">
                            <div class="mt-5">
                                <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                                <h3 class="h4 mb-2 text-black font-weight-bold">Wiring Jobs</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <a class="text-decoration-none" href="https://iselcouno.com/services/kuryentipid-tips">
                            <div class="mt-5">
                                <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                                <h3 class="h4 mb-2 text-black font-weight-bold">Kuryentipid Tips</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="../../../assets/images/portfolio/fullsize/1.jpg" title="Project Name">
                            <img class="img-fluid" src="../../../assets/images/portfolio/thumbnails/1.jpg" alt="..." />
                            <!-- <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Category</div>
                                <div class="project-name">Project Name</div>
                            </div> -->
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="../../../assets/images/portfolio/fullsize/2.jpg" title="Project Name">
                            <img class="img-fluid" src="../../../assets/images/portfolio/thumbnails/2.jpg" alt="..." />
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="../../../assets/images/portfolio/fullsize/3.jpg" title="Project Name">
                            <img class="img-fluid" src="../../../assets/images/portfolio/thumbnails/3.jpg" alt="..." />
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="../../../assets/images/portfolio/fullsize/4.jpg" title="Project Name">
                            <img class="img-fluid" src="../../../assets/images/portfolio/thumbnails/4.jpg" alt="..." />
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="../../../assets/images/portfolio/fullsize/5.jpg" title="Project Name">
                            <img class="img-fluid" src="../../../assets/images/portfolio/thumbnails/5.jpg" alt="..." />
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="../../../assets/images/portfolio/fullsize/6.jpg" title="Project Name">
                            <img class="img-fluid" src="../../../assets/images/portfolio/thumbnails/6.jpg" alt="..." />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to action-->
        <section class="page-section bg-dark text-white" id="applicationForm">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">You Need Electric Meter?</h2>
                <a class="btn btn-primary btn-xl" href="#form">Apply Now!</a>
            </div>
        </section>
        <!-- Form-->
<?php   if(!$is_login){
?>       <section class="page-section">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0" id="form">Application Form</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">please complete all required fields</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <form action="/users/application" method="post">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                
                            <div class="form-floating mb-3">
                                <input class="form-control" name="firstname" id="firstname" value="<?php echo set_value('firstname'); ?>" type="text"/>
                                <label for="firstname">First name</label>
                                <?php echo form_error('firstname') ?>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="lastname" value="<?php echo set_value('lastname'); ?>" id="lastname" type="text"/>
                                <label for="lastname">Last name</label>
                                <?php echo form_error('lastname') ?>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" name="email" id="email" type="email" value="<?php echo set_value('email'); ?>"/>
                                <label for="email">Email address</label>
                                <?php echo form_error('email') ?>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" name="phone" id="phone" value="<?php echo set_value('phone'); ?>" />
                                <label for="phone">Phone number</label>
                                <?php echo form_error('phone') ?>
                            </div>
                            <hr class="divider" />
                            <p class="text-muted mb-5 text-center">Complete Address</p>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="street" value="<?php echo set_value('street'); ?>" id="street" type="text"/>
                                <label for="street">Blk/St/Subdivision</label>
                                <?php echo form_error('street') ?>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="baranggay" value="<?php echo set_value('baranggay'); ?>" id="baranggay" type="text"/>
                                <label for="baranggay">Baranggay</label>
                                <?php echo form_error('baranggay') ?>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="city" value="<?php echo set_value('city'); ?>" id="city" type="text"/>
                                <label for="city">City</label>
                                <?php echo form_error('city') ?>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-xl" type="submit">Submit Application</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>       
<?php   }
        else{
?>        <section class="page-product" id="products">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0" id="form">List of products</h2>
                        <hr class="divider" />
                    </div>
                </div>
                <div class="row">
<?php               foreach($product as $data){
?>                    <div class="col-sm-4 mt-2 mb-2">
                        <div class="card">
                            <img src="/assets/images/upload/<?=$data['image']?>" class="product_img card-img-top img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?=$data['name']?></h5>
                                <p class="card-text"><?=$data['description']?></p>
                                <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#apply" onclick="showProduct('<?=$data['id']?>')">Apply</a>
                            </div>
                        </div>
                    </div>
<?php               }
?>                </div>
            </div>
        </section>
<?php   }
?> 


        <!-- Modal Apply-->
        <div class="modal fade" id="apply" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Product Application</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="details" id="body-apply">
                            <div class="row">
                                <div class="col-sm mt-2" id="product_details"></div>
                                <div class="col-sm mt-2">
                                    <div class="card">
                                        <div class="modal-header">
                                           <p><strong>Applied for?:</strong></p> 
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                            <div class="form-group">
                                                <label for="blk">Blk</label>
                                                <input type="text" name="blk" class="form-control" placeholder="P BLK LOT House#">
                                                <?php echo form_error('current') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="baranggay">Baranggay</label>
                                                <input type="text" name="baranggay" class="form-control" placeholder="Baranggay">
                                                <?php echo form_error('new') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="city">City/Municipality</label>
                                                <input type="text" name="city" class="form-control" placeholder="City / Municipality">
                                                <?php echo form_error('confirm') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </div>
        </div>
