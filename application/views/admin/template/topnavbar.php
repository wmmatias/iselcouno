<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="page-wrapper">
          <!-- Header -->
          <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <div class="search-form d-none d-lg-inline-block"></div>
              <div class="navbar-right ">
                <ul class="nav navbar-nav">
                  <li class="dropdown notifications-menu custom-dropdown">
                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <span class="d-none d-lg-inline-block"><?=$this->session->userdata('fullname')?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <a href="user-profile.html" data-toggle="modal" data-target="#profile">
                          <i class="mdi mdi-account"></i> My Profile
                        </a>
                      </li>
                      <li class="dropdown-footer">
                        <a href="/users/signoff"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </header>

  <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="profile" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLarge">My Profile</h5>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="edit" value="edit">
          <label class="form-check-label" for="edit">Edit Details</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="change" value="change">
          <label class="form-check-label" for="change">Change Password</label>
        </div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
        <div class="details" id="details">
        </div>
			</div>
		</div>
	</div>
</div>