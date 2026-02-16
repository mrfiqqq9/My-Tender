
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

</div>
<h2 class="mb-4">Vendor Dashboard</h2>

<div class="card shadow border-0 mb-4 text-white"
     style="background: linear-gradient(135deg,#0b2e59,#1a4d8f); border-radius: 18px;">
<div class="card-body p-4">

<h5 class="mb-3">
    <i class="bi bi-person-circle me-2 text-primary"></i>
    Personal Information
</h5>

<div class="row">

<div class="col-md-6 mb-2">
    <strong>Name:</strong><br>
    <?= h($user->name) ?>
</div>

<div class="col-md-6 mb-2">
    <strong>Email:</strong><br>
    <?= h($user->email) ?>
</div>

<div class="col-md-6 mb-2">
    <strong>Role:</strong><br>
    <?=
        $user->role == 1 ? 'Administrator' :
        ($user->role == 2 ? 'Staff' : 'Vendor')
    ?>
</div>

</div>

</div>
</div>


<?php if (!$vendor): ?>

<div class="card shadow-sm">
<div class="card-body text-center p-5">
<h5>You are not registered as a vendor.</h5>

<?= $this->Html->link(
    'Apply as Vendor',
    ['controller'=>'Vendors','action'=>'add'],
    ['class'=>'btn btn-primary mt-3']
) ?>
</div>
</div>

<?php else: ?>

<!-- ================= PROFILE CARD ================= -->
<div class="card shadow-sm mb-4">
<div class="card-body">

<h4><?= h($vendor->company_name) ?></h4>

<p>
<strong>Status:</strong>
<?= match ($vendor->vendor_status) {
    0 => '<span class="badge bg-warning text-dark">Pending Approval</span>',
    1 => '<span class="badge bg-success">Approved</span>',
    2 => '<span class="badge bg-danger">Rejected</span>',
    3 => '<span class="badge bg-secondary">Suspended</span>',
} ?>
</p>

</div>
</div>

<?php if ($vendor->vendor_status === 1): ?>

<h4 class="mb-3">Active Tenders</h4>

<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-striped align-middle mb-0">
<thead class="table-dark">
<tr>
<th>Title</th>
<th>Closing Date</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php foreach ($tenders as $tender): ?>
<tr>
<td><?= h($tender->title) ?></td>
<td><?= h($tender->closing_date) ?></td>
<td>
<?= $this->Html->link(
    'View',
    ['controller'=>'Tenders','action'=>'view',$tender->tender_id],
    ['class'=>'btn btn-sm btn-outline-primary']
) ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>

<?php endif; ?>

<?php endif; ?>

<!-- ================= LATEST NEWS ================= -->
<h4 class="mt-5 mb-3">Latest News</h4>

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
