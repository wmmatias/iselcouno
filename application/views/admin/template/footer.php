<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</div> <!-- End Content Wrapper -->
    <!-- Footer -->
    <footer class="footer mt-auto">
      <div class="copyright bg-white">
        <p>
          Copyright &copy; <span id="copy-year"></span> Iselco-Uno
        </p>
      </div>
      <script>
        var d = new Date();
        var year = d.getFullYear();
        document.getElementById("copy-year").innerHTML = year;
      </script>
    </footer>

    </div> <!-- End Page Wrapper -->
  </div> <!-- End Wrapper -->
    <!-- <script type="module">
      import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

      const el = document.createElement('pwa-update');
      document.body.appendChild(el);
    </script> -->

    <!-- Javascript -->
    <!-- <script src="/assets/plugins/jquery/jquery.min.js"></script> -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/plugins/simplebar/simplebar.min.js"></script>
    <script src='/assets/plugins/charts/Chart.min.js'></script>
    <!-- <script src='/assets/js/chart.js'></script> -->
    <script src='/assets/plugins/daterangepicker/moment.min.js'></script>
    <script src='/assets/plugins/daterangepicker/daterangepicker.js'></script>
    <script src='/assets/js/date-range.js'></script>
    <script src='/assets/plugins/toastr/toastr.min.js'></script>
    <script src="/assets/js/sleek.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

    <script>

      /*======== 3. MONTHLY CHART ========*/
      var monthly = document.getElementById("monthly");
      if (monthly !== null) {
        var chart = new Chart(monthly, {
          // The type of chart we want to create
          type: "line",
    
          // The data for our dataset
          data: {
            labels: [
<?php         foreach($mchart as $mdata){
?>              "<?=date('M-d', strtotime($mdata['created_at']))?>",
<?php         }
?>
            ],
            datasets: [
              {
                label: "",
                backgroundColor: "transparent",
                borderColor: "rgb(82, 136, 255)",
                data: [
<?php         foreach($mchart as $mdata){
?>              "<?=$mdata['total_amount']?>",
<?php         }
?>
                ],
                lineTension: 0.3,
                pointRadius: 5,
                pointBackgroundColor: "rgba(255,255,255,1)",
                pointHoverBackgroundColor: "rgba(255,255,255,1)",
                pointBorderWidth: 2,
                pointHoverRadius: 8,
                pointHoverBorderWidth: 1
              }
            ]
          },
    
          // Configuration options go here
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: false
            },
            layout: {
              padding: {
                right: 10
              }
            },
            scales: {
              xAxes: [
                {
                  gridLines: {
                    display: false
                  }
                }
              ],
              yAxes: [
                {
                  gridLines: {
                    display: true,
                    color: "#eee",
                    zeroLineColor: "#eee",
                  },
                  ticks: {
                    callback: function(value) {
                      var ranges = [
                        { divider: 1e6, suffix: "M" },
                        { divider: 1e4, suffix: "k" }
                      ];
                      function formatNumber(n) {
                        for (var i = 0; i < ranges.length; i++) {
                          if (n >= ranges[i].divider) {
                            return (
                              (n / ranges[i].divider).toString() + ranges[i].suffix
                            );
                          }
                        }
                        return n;
                      }
                      return formatNumber(value);
                    }
                  }
                }
              ]
            },
            tooltips: {
              callbacks: {
                title: function(tooltipItem, data) {
                  return data["labels"][tooltipItem[0]["index"]];
                },
                label: function(tooltipItem, data) {
                  return "₱" + data["datasets"][0]["data"][tooltipItem["index"]];
                }
              },
              responsive: true,
              intersect: false,
              enabled: true,
              titleFontColor: "#888",
              bodyFontColor: "#555",
              titleFontSize: 12,
              bodyFontSize: 18,
              backgroundColor: "rgba(256,256,256,0.95)",
              xPadding: 20,
              yPadding: 10,
              displayColors: false,
              borderColor: "rgba(220, 220, 220, 0.9)",
              borderWidth: 2,
              caretSize: 10,
              caretPadding: 15
            }
          }
        });
      }

      /*======== 3. Daily CHART ========*/
      var ctx = document.getElementById("linechart");
      if (ctx !== null) {
        var chart = new Chart(ctx, {
          // The type of chart we want to create
          type: "line",
    
          // The data for our dataset
          data: {
            labels: [
              "<?=(empty($ychart) ? '-':date('M-d', strtotime($ychart[0]['created_at'])))?>",
              "<?=(empty($dchart) ? '-':date('M-d', strtotime($dchart[0]['created_at'])))?>"
            ],
            datasets: [
              {
                label: "",
                backgroundColor: "transparent",
                borderColor: "rgb(82, 136, 255)",
                data: [
                  <?=(empty($ychart) ? '0':$ychart[0]['total_amount'])?>,
                  <?=(empty($dchart) ? '0':$dchart[0]['total_amount'])?>
                ],
                lineTension: 0.3,
                pointRadius: 5,
                pointBackgroundColor: "rgba(255,255,255,1)",
                pointHoverBackgroundColor: "rgba(255,255,255,1)",
                pointBorderWidth: 2,
                pointHoverRadius: 8,
                pointHoverBorderWidth: 1
              }
            ]
          },
    
          // Configuration options go here
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: false
            },
            layout: {
              padding: {
                right: 10
              }
            },
            scales: {
              xAxes: [
                {
                  gridLines: {
                    display: false
                  }
                }
              ],
              yAxes: [
                {
                  gridLines: {
                    display: true,
                    color: "#eee",
                    zeroLineColor: "#eee",
                  },
                  ticks: {
                    callback: function(value) {
                      var ranges = [
                        { divider: 1e6, suffix: "M" },
                        { divider: 1e4, suffix: "k" }
                      ];
                      function formatNumber(n) {
                        for (var i = 0; i < ranges.length; i++) {
                          if (n >= ranges[i].divider) {
                            return (
                              (n / ranges[i].divider).toString() + ranges[i].suffix
                            );
                          }
                        }
                        return n;
                      }
                      return formatNumber(value);
                    }
                  }
                }
              ]
            },
            tooltips: {
              callbacks: {
                title: function(tooltipItem, data) {
                  return data["labels"][tooltipItem[0]["index"]];
                },
                label: function(tooltipItem, data) {
                  return "₱" + data["datasets"][0]["data"][tooltipItem["index"]];
                }
              },
              responsive: true,
              intersect: false,
              enabled: true,
              titleFontColor: "#888",
              bodyFontColor: "#555",
              titleFontSize: 12,
              bodyFontSize: 18,
              backgroundColor: "rgba(256,256,256,0.95)",
              xPadding: 20,
              yPadding: 10,
              displayColors: false,
              borderColor: "rgba(220, 220, 220, 0.9)",
              borderWidth: 2,
              caretSize: 10,
              caretPadding: 15
            }
          }
        });
      }

      /*======== 3. Daily CHART ========*/
      var weekly = document.getElementById("weekly");
      if (weekly !== null) {
        var chart = new Chart(weekly, {
          // The type of chart we want to create
          type: "line",
    
          // The data for our dataset
          data: {
            labels: [
<?php         foreach($wchart as $wdata){
?>              "<?=date('M-d', strtotime($wdata['created_at']))?>",
<?php         }
?>
            ],
            datasets: [
              {
                label: "",
                backgroundColor: "transparent",
                borderColor: "rgb(82, 136, 255)",
                data: [
<?php         foreach($wchart as $wdata){
?>              "<?=$wdata['total_amount']?>",
<?php         }
?>
                ],
                lineTension: 0.3,
                pointRadius: 5,
                pointBackgroundColor: "rgba(255,255,255,1)",
                pointHoverBackgroundColor: "rgba(255,255,255,1)",
                pointBorderWidth: 2,
                pointHoverRadius: 8,
                pointHoverBorderWidth: 1
              }
            ]
          },
    
          // Configuration options go here
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: false
            },
            layout: {
              padding: {
                right: 10
              }
            },
            scales: {
              xAxes: [
                {
                  gridLines: {
                    display: false
                  }
                }
              ],
              yAxes: [
                {
                  gridLines: {
                    display: true,
                    color: "#eee",
                    zeroLineColor: "#eee",
                  },
                  ticks: {
                    callback: function(value) {
                      var ranges = [
                        { divider: 1e6, suffix: "M" },
                        { divider: 1e4, suffix: "k" }
                      ];
                      function formatNumber(n) {
                        for (var i = 0; i < ranges.length; i++) {
                          if (n >= ranges[i].divider) {
                            return (
                              (n / ranges[i].divider).toString() + ranges[i].suffix
                            );
                          }
                        }
                        return n;
                      }
                      return formatNumber(value);
                    }
                  }
                }
              ]
            },
            tooltips: {
              callbacks: {
                title: function(tooltipItem, data) {
                  return data["labels"][tooltipItem[0]["index"]];
                },
                label: function(tooltipItem, data) {
                  return "₱" + data["datasets"][0]["data"][tooltipItem["index"]];
                }
              },
              responsive: true,
              intersect: false,
              enabled: true,
              titleFontColor: "#888",
              bodyFontColor: "#555",
              titleFontSize: 12,
              bodyFontSize: 18,
              backgroundColor: "rgba(256,256,256,0.95)",
              xPadding: 20,
              yPadding: 10,
              displayColors: false,
              borderColor: "rgba(220, 220, 220, 0.9)",
              borderWidth: 2,
              caretSize: 10,
              caretPadding: 15
            }
          }
        });
      }
      
      
    </script>
</body>
</html>

