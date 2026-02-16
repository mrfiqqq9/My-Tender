<h2 class="mb-4 fw-bold">Admin Analytics Dashboard</h2>

<style>
.dashboard-card {
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    border: none;
}
.chart-box {
    height: 320px;
    position: relative;
}
.table-card {
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    border: none;
}
.badge-count {
    font-size: 0.85rem;
    padding: 6px 10px;
}
</style>

<div class="container-fluid">

<!-- ================= Row 1 ================= -->
<div class="row g-4 mb-4">

<div class="col-lg-6">
<div class="card dashboard-card p-4">
<h5 class="mb-3 fw-semibold">Tender Status Breakdown</h5>
<div class="chart-box">
<canvas id="tenderChart"></canvas>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="card dashboard-card p-4">
<h5 class="mb-3 fw-semibold">Monthly Applications Trend</h5>
<div class="chart-box">
<canvas id="monthlyChart"></canvas>
</div>
</div>
</div>

</div>

<!-- ================= Top Vendors ================= -->
<div class="row">
<div class="col-lg-12">
<div class="card table-card p-4">
<h5 class="mb-3 fw-semibold">Top 5 Vendors</h5>

<?php if (!empty($advanced['topVendors'])): ?>
<div class="table-responsive">
<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
<th>Vendor Name</th>
<th class="text-center">Total Applications</th>
</tr>
</thead>
<tbody>
<?php foreach ($advanced['topVendors'] as $vendor): ?>
<tr>
<td><?= h($vendor['company_name'] ?? 'Unknown') ?></td>
<td class="text-center">
<span class="badge bg-primary badge-count">
<?= $vendor['count'] ?? 0 ?>
</span>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php else: ?>
<p class="text-muted">No vendor data available.</p>
<?php endif; ?>

</div>
</div>
</div>

</div>

<hr class="my-5">

<!-- ================= Row 2 ================= -->
<div class="row g-4">

<div class="col-lg-6">
<div class="card dashboard-card p-4">
<h5>Application Status Breakdown</h5>
<div class="chart-box">
<canvas id="applicationChart"></canvas>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="card dashboard-card p-4">
<h5>Category Performance</h5>
<div class="chart-box">
<canvas id="categoryChart"></canvas>
</div>
</div>
</div>

</div>


<hr class="my-5">

<!-- ================= Revenue ================= -->
<div class="row g-4">

<div class="col-lg-6">
<div class="card dashboard-card p-4">
<h5>Total Revenue (Approved Projects)</h5>
<h2 class="fw-bold text-success">
RM <?= number_format($advanced['totalRevenue'] ?? 0, 2) ?>
</h2>
</div>
</div>

<div class="col-lg-6">
<div class="card dashboard-card p-4">
<h5>Overall Approval Rate</h5>
<h2 class="fw-bold text-success">
<?= $advanced['approvalRate'] ?? 0 ?>%
</h2>
</div>
</div>

</div>

<hr class="my-5">



<div class="card dashboard-card p-4">
<h5>Monthly Revenue Trend</h5>
<div class="chart-box">
<canvas id="revenueChart"></canvas>
</div>
</div>




<hr class="my-5">

<!-- ================= Vendor Success Rate ================= -->
<div class="card dashboard-card p-4">
<h5>Vendor Approval Success Rate</h5>

<?php if (!empty($advanced['vendorSuccessRate'])): ?>
<div class="table-responsive">
<table class="table table-hover">
<thead class="table-light">
<tr>
<th>Vendor</th>
<th>Total Applications</th>
<th>Approved</th>
<th>Success Rate</th>
</tr>
</thead>
<tbody>
<?php foreach ($advanced['vendorSuccessRate'] as $vendor): ?>
<tr>
<td><?= h($vendor['company_name'] ?? 'Unknown') ?></td>
<td><?= $vendor['total'] ?? 0 ?></td>
<td><?= $vendor['approved'] ?? 0 ?></td>
<td>
<span class="badge bg-success">
<?= $vendor['success_rate'] ?? 0 ?>%
</span>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php else: ?>
<p class="text-muted">No vendor success data available.</p>
<?php endif; ?>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

/* =========================================================
   STATUS LABEL MAPPING (GLOBAL)
========================================================= */

const statusMap = {
    0: 'Draft',
    1: 'Open',
    2: 'Closed',
    3: 'Archived'
};

const statusColors = {
    0: '#6c757d',
    1: '#0d6efd',
    2: '#198754',
    3: '#dc3545'
};


/* ================= TENDER STATUS ================= */

const tenderData = <?= json_encode($advanced['tenderStatus'] ?? []) ?>;

if (tenderData.length > 0) {
    new Chart(document.getElementById('tenderChart'), {
        type: 'doughnut',
        data: {
            labels: tenderData.map(t => statusMap[t.status] ?? 'Unknown'),
            datasets: [{
                data: tenderData.map(t => t.count),
                backgroundColor: tenderData.map(t => statusColors[t.status] ?? '#999')
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
}


/* ================= MONTHLY APPLICATIONS ================= */

const monthlyData = <?= json_encode($advanced['monthlyApplications'] ?? []) ?>;

if (monthlyData.length > 0) {
    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: monthlyData.map(m => m.month + '/' + m.year),
            datasets: [{
                label: 'Applications',
                data: monthlyData.map(m => m.count),
                borderColor: '#0d6efd',
                tension: 0.3,
                fill: false
            }]
        },
        options: { maintainAspectRatio: false }
    });
}


/* ================= APPLICATION STATUS ================= */

const applicationStatus = <?= json_encode($advanced['applicationStatus'] ?? []) ?>;

if (applicationStatus.length > 0) {
    new Chart(document.getElementById('applicationChart'), {
        type: 'bar',
        data: {
            labels: applicationStatus.map(s => statusMap[s.status] ?? 'Unknown'),
            datasets: [{
                data: applicationStatus.map(s => s.count),
                backgroundColor: applicationStatus.map(s => statusColors[s.status] ?? '#999')
            }]
        },
        options: { maintainAspectRatio: false }
    });
}


/* ================= CATEGORY ================= */

const categoryData = <?= json_encode($advanced['categoryPerformance'] ?? []) ?>;

if (categoryData.length > 0) {
    new Chart(document.getElementById('categoryChart'), {
        type: 'pie',
        data: {
            labels: categoryData.map(c => c.category_name),
            datasets: [{
                data: categoryData.map(c => c.count)
            }]
        },
        options: { maintainAspectRatio: false }
    });
}


/* ================= REVENUE ================= */

const revenueData = <?= json_encode($advanced['monthlyRevenue'] ?? []) ?>;

if (revenueData.length > 0) {
    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: revenueData.map(r => r.month + '/' + r.year),
            datasets: [{
                label: 'Revenue (RM)',
                data: revenueData.map(r => r.total),
                borderColor: '#198754',
                tension: 0.3,
                fill: false
            }]
        },
        options: { maintainAspectRatio: false }
    });
}

</script>

