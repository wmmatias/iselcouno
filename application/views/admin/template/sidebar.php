<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="/" title="Iselco-Uno">
                <img src="/assets/images/logo.png" alt="Iselco Logo">
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="has-sub">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                    aria-expanded="false" aria-controls="dashboard">
                    <i class="mdi mdi-server"></i>
                    <span class="nav-text">Credentials</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse" id="dashboard" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="active">
                        <a class="sidenav-item-link" href="/dashboards/user_list">
                          <span class="nav-text">Users</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                    aria-expanded="false" aria-controls="app">
                    <i class="mdi mdi-pencil-box-multiple"></i>
                    <span class="nav-text">Forms & List</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="app" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="/dashboards/product_list">
                          <span class="nav-text">Products</span>
                        </a>
                      </li>
                      <li class="">
                        <a class="sidenav-item-link" href="/dashboards/application_list">
                          <span class="nav-text">Application</span>
                        </a>
                      </li>
                      <li class="">
                        <a class="sidenav-item-link" href="/dashboards/transaction_list">
                          <span class="nav-text">Transaction</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>
                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#report"
                    aria-expanded="false" aria-controls="report">
                    <i class="mdi mdi-chart-bar"></i>
                    <span class="nav-text">Reports/Backup</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="report" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="/dashboards/report">
                          <span class="nav-text">Reports</span>
                        </a>
                      </li>
                      <li class="">
                        <a class="sidenav-item-link" href="/dashboards/export_backup">
                          <span class="nav-text">Backup</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>

            <div class="sidebar-footer">
              <hr class="separator mb-0" />
              <div class="sidebar-footer-content">
                <h6 class="text-uppercase">
                  Login as: <span class="float-right">Admin</span>
                </h6>
              </div>
            </div>
          </div>
        </aside>