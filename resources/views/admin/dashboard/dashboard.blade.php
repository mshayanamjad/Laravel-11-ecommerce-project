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
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <div class="card-title mb-1">Admin Notifications</div>
              <small class="text-muted">
                {{ $unreadNotifications }} unread {{ $unreadNotifications === 1 ? 'notification' : 'notifications' }}
              </small>
            </div>
            <a href="{{ route('admin.notifications') }}" class="btn btn-primary btn-sm">
              <i class="fa fa-list me-1"></i> View all
            </a>
          </div>
          <div class="card-body p-0">
            @forelse ($notifications as $notification)
              <a href="{{ route('admin.notifications.read', ['id' => $notification->id]) }}" class="d-flex align-items-start gap-3 p-3 border-bottom text-decoration-none {{ $notification->read_at ? '' : 'bg-light' }}">
                <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 36px; height: 36px; flex: 0 0 36px;">
                  <i class="fa {{ data_get($notification, 'data.type') === 'order' ? 'fa-shopping-cart' : 'fa-bell' }}"></i>
                </span>
                <span class="flex-grow-1">
                  <span class="d-flex justify-content-between align-items-start gap-2">
                    <strong class="text-dark">{{ data_get($notification, 'data.title', 'Notification') }}</strong>
                    @if (is_null($notification->read_at))
                      <span class="badge bg-primary rounded-pill">New</span>
                    @endif
                  </span>
                  <span class="d-block text-muted small mt-1">{{ data_get($notification, 'data.message', 'No message') }}</span>
                  <span class="d-block text-muted small mt-1">{{ $notification->created_at->diffForHumans() }}</span>
                </span>
              </a>
            @empty
              <div class="p-5 text-center text-muted">
                <i class="fa fa-check-circle text-success mb-2" style="font-size: 28px;"></i>
                <p class="mb-0">You are all caught up.</p>
              </div>
            @endforelse
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
  const salesData = @json($dailySales);
  const dailySalesChart = document.getElementById('dailySalesChart');

  if (dailySalesChart) {
    new Chart(dailySalesChart.getContext('2d'), {
      type: 'line',
      data: {
        labels: salesData.map((sale) => sale.date),
        datasets: [{
          label: 'Sales',
          data: salesData.map((sale) => sale.total_sales),
          fill: true,
          backgroundColor: 'rgba(255, 255, 255, 0.2)',
          borderColor: '#fff',
          tension: 0.4,
          pointRadius: 2,
          pointBackgroundColor: '#fff'
        }]
      },
      options: {
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, ticks: { color: '#fff' }, grid: { display: false } },
          x: { ticks: { color: '#fff' }, grid: { display: false } }
        }
      }
    });
  }
</script>
@endsection
