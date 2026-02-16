
    <!-- ================= HERO SLIDER ================= -->
<div id="dashboardCarousel" class="carousel slide mb-4" data-bs-ride="carousel">

    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="3"></button>
    </div>

    <div class="carousel-inner rounded shadow">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="/my-tender/img/slider/uitm1.jpg"
                 class="d-block w-100"
                 style="height:400px;object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
                <h2>Welcome to MyTender UiTM</h2>
                <p>Official Tender Management System</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="/my-tender/img/slider/uitm2.jpg"
                 class="d-block w-100"
                 style="height:400px;object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
                <h2>Transparent & Efficient</h2>
                <p>Digital Tender Management Platform</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="/my-tender/img/slider/uitm3.jpg"
                 class="d-block w-100"
                 style="height:400px;object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
                <h2>Vendor Registration</h2>
                <p>Secure and Reliable System</p>
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="carousel-item">
            <img src="/my-tender/img/slider/uitm3.webp"
                 class="d-block w-100"
                 style="height:400px;object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
                <h2>University Excellence</h2>
                <p>Supporting UiTM Procurement</p>
            </div>
        </div>

    </div>

    
    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

<h2 class="mb-4">Dashboard</h2>

</div>
<?php if (!empty($staff)) : ?>

<div class="card shadow border-0 mb-4 text-white"
     style="background: linear-gradient(135deg,#0b2e59,#1a4d8f); border-radius: 18px;">
<div class="card-body p-4">

<h5 class="mb-4 fw-semibold">
    <i class="bi bi-person-badge me-2"></i>
    Staff Information
</h5>

<div class="row g-3">

<div class="col-md-6">
    <div class="small text-white-50">Name</div>
    <div class="fs-6 fw-medium"><?= h($staff->staff_name) ?></div>
</div>

<div class="col-md-6">
    <div class="small text-white-50">Department</div>
    <div class="fs-6 fw-medium"><?= h($staff->department) ?></div>
</div>

<div class="col-md-6">
    <div class="small text-white-50">Position</div>
    <div class="fs-6 fw-medium"><?= h($staff->position) ?></div>
</div>

<div class="col-md-6">
    <div class="small text-white-50">Email</div>
    <div class="fs-6 fw-medium"><?= h($user->email) ?></div>
</div>

</div>

</div>
</div>


<?php endif; ?>

<!-- ================= KPI CARDS ================= -->
<div class="row g-4 mb-4">

<div class="col-md-3">
<div class="card shadow-sm text-center border-primary">
<div class="card-body">
<h6>Total Tenders</h6>
<h3><?= $stats['totalTenders'] ?></h3>
<p class="text-muted mb-0">
Open: <?= $stats['openTenders'] ?>
</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card shadow-sm text-center border-warning">
<div class="card-body">
<h6>Total Applications</h6>
<h3><?= $stats['totalApplications'] ?></h3>
<p class="mb-0">
<span class="badge bg-warning text-dark">
Pending: <?= $stats['pendingApplications'] ?>
</span>
<span class="badge bg-success">
Approved: <?= $stats['approvedApplications'] ?>
</span>
</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card shadow-sm text-center border-info">
<div class="card-body">
<h6>Total Vendors</h6>
<h3><?= $stats['totalVendors'] ?></h3>
<p class="mb-0">
<span class="badge bg-warning text-dark">
Pending: <?= $stats['pendingVendors'] ?>
</span>
</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card shadow-sm text-center border-success">
<div class="card-body">
<h6>Total Staff</h6>
<h3><?= $stats['totalStaff'] ?></h3>
</div>
</div>
</div>

</div>

<!-- ================= LATEST APPLICATIONS ================= -->
<h4 class="mb-3">Latest Tender Applications</h4>

<div class="card shadow-sm mb-4">
<div class="card-body p-0">

<table class="table table-striped align-middle mb-0">
<thead class="table-dark">
<tr>
<th>Company</th>
<th>Tender</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php foreach ($latestApplications as $app): ?>
<tr>
<td><?= h($app->vendor->company_name) ?></td>
<td><?= h($app->tender->title) ?></td>
<td>
<?= match ($app->status) {
    0 => '<span class="badge bg-warning text-dark">Pending</span>',
    1 => '<span class="badge bg-success">Approved</span>',
    2 => '<span class="badge bg-danger">Rejected</span>',
} ?>
</td>
<td>
<?= $this->Html->link(
    'View',
    ['controller'=>'TenderApplications','action'=>'view',$app->application_id],
    ['class'=>'btn btn-sm btn-outline-primary']
) ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>

<!-- ================= LATEST VENDORS ================= -->
<h4 class="mb-3">Latest Vendor Registrations</h4>

<div class="card shadow-sm mb-4">
<div class="card-body p-0">

<table class="table table-striped align-middle mb-0">
<thead class="table-dark">
<tr>
<th>Company</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php foreach ($latestVendors as $vendor): ?>
<tr>
<td><?= h($vendor->company_name) ?></td>
<td>
<?= match ($vendor->vendor_status) {
    0 => '<span class="badge bg-warning text-dark">Pending</span>',
    1 => '<span class="badge bg-success">Approved</span>',
    2 => '<span class="badge bg-danger">Rejected</span>',
    3 => '<span class="badge bg-secondary">Suspended</span>',
} ?>
</td>
<td>
<?= $this->Html->link(
    'View',
    ['controller'=>'Vendors','action'=>'view',$vendor->vendor_id],
    ['class'=>'btn btn-sm btn-outline-primary']
) ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>

<!-- ================= LATEST NEWS ================= -->
<h4 class="mb-3">Latest News</h4>

<div class="row g-4">

<?php foreach ($latestNews as $news): ?>
<div class="col-md-3">
<div class="card shadow-sm h-100">

<?php if ($news->image): ?>
<img src="<?= $this->Url->image('img/news/'.$news->image) ?>"
     class="card-img-top"
     style="height:180px;object-fit:cover;">
<?php endif; ?>

<div class="card-body">
<h6><?= h($news->title) ?></h6>
<p class="text-muted small">
<?= h($news->description) ?>
</p>
</div>

</div>
</div>
<?php endforeach; ?>

</div>
