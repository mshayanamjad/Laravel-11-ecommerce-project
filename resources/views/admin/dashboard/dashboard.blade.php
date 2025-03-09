@extends('admin.layouts.app')

@section('content')
    
<!-- Main Content -->
<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-primary bubble-shadow-small"
                >
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Users</p>
                  <h4 class="card-title">{{ $customers }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-info bubble-shadow-small"
                >
                  <i class="fas fa-user-check"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Subscribers</p>
                  <h4 class="card-title">1303</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-success bubble-shadow-small"
                >
                  <i class="fas fa-luggage-cart"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Sales</p>
                  <h4 class="card-title">$ {{ number_format($totalSales, 2) }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-secondary bubble-shadow-small"
                >
                  <i class="far fa-check-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Order</p>
                  <h4 class="card-title">{{ $totalOrders }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div class="card-head-row">
              <div class="card-title">Sale Statistics</div>
              <div class="card-tools">
                <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                  <span class="btn-label">
                    <i class="fa fa-pencil"></i>
                  </span>
                  Export
                </a>
                <a href="#" class="btn btn-label-info btn-round btn-sm">
                  <span class="btn-label">
                    <i class="fa fa-print"></i>
                  </span>
                  Print
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-container" style="min-height: 375px"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
              <canvas id="statisticsChart" style="display: block; width: 764px; height: 375px;" width="764" height="375" class="chartjs-render-monitor"></canvas>
            </div>
            {{-- <div id="myChartLegend"></div> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-primary card-round">
          <div class="card-header">
            <div class="card-head-row">
              <div class="card-title">Daily Sales</div>
              <div class="card-tools">
                <div class="dropdown">
                  <button class="btn btn-sm btn-label-light" id="exportExcel">Export</button>
                </div>
              </div>
            </div>
            <div id="this_month" class="card-category">March 25 - April 02</div>
          </div>
          <div class="card-body py-0">
            <div class="mb-4 mt-2">
              <h2>${{ number_format($dailySalesCount, 2) }}</h2>
            </div>
            <div class="pull-in">
              <canvas id="dailySalesChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('customJs')
<script>
let today = new Date();
let startDate = new Date();
startDate.setDate(today.getDate() - 6); // Get 6 days ago (since today is included)

// Array of month names
const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

// Format start and end date
let startDay = startDate.getDate();
let startMonth = monthNames[startDate.getMonth()];

let endDay = today.getDate();
let endMonth = monthNames[today.getMonth()];

// Construct the date range string
let dateRange = `${startMonth} ${startDay} - ${endMonth} ${endDay}`;

// Select all elements with ID "this_month" and update them
document.querySelectorAll("#this_month").forEach(element => {
    element.textContent = dateRange;
});


  var salesData = @json($dailySales);  // Prepare sales data for export
  var dailyLabels = salesData.map((sale) => sale.date); // Example labels
  var dailySalesData = salesData.map((sale) => sale.total_sales); // Example dynamic sales data

  var dailySalesChart = document
    .getElementById("dailySalesChart")
    .getContext("2d");

  var myDailySalesChart = new Chart(dailySalesChart, {
      type: "line",
      data: {
          labels: dailyLabels,
          datasets: [
              {
                  label: "Sales Analytics",
                  fill: !0,
                  backgroundColor: "rgba(255,255,255,0.2)",
                  borderColor: "#fff",
                  borderCapStyle: "butt",
                  borderDash: [],
                  borderDashOffset: 0,
                  pointBorderColor: "#fff",
                  pointBackgroundColor: "#fff",
                  pointBorderWidth: 1,
                  pointHoverRadius: 5,
                  tension: 0.4, // Smooths the line
                  pointHoverBackgroundColor: "#fff",
                  pointHoverBorderColor: "#fff",
                  pointHoverBorderWidth: 0,
                  pointRadius: 1,
                  pointHitRadius: 5,
                  data: dailySalesData,
              },
          ],
      },
      options: {
          maintainAspectRatio: false,
          layout: {
              padding: {
                  left: 20,  // ⬅️ Adds left padding
                  right: 20, // ➡️ Adds right padding
                  bottom: 20,
              },
          },
          plugins: {
              legend: {
                  display: false,
              },
          },
          animation: {
              easing: "easeInOutBack",
          },
          scales: {
              y: {
                  ticks: {
                      color: "#fff",
                      beginAtZero: true,
                  },
                  grid: {
                      display: false, // ❌ Removes y-axis grid lines
                      drawBorder: false,
                  },
              },
              x: {
                  ticks: {
                      color: "#fff",
                  },
                  grid: {
                      display: false, // ❌ Removes x-axis grid lines
                      drawBorder: false,
                  },
              },
          },
      },
  });

  document.getElementById("exportExcel").addEventListener("click", function () {

    // Create an array of objects for Excel
    let dataForExcel = salesData.map(sale => ({
        "Date": sale.date,
        "Total Sales (USD)": sale.total_sales
    }));

    // Convert data to a worksheet
    let worksheet = XLSX.utils.json_to_sheet(dataForExcel);

    // Create a workbook and append the worksheet
    let workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Sales Report");

    // Export the workbook to an Excel file
    XLSX.writeFile(workbook, "Last_7_Days_Sales.xlsx");
});


</script>
@endsection
