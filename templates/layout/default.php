<!DOCTYPE html>
<html>
<head>
<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>MyTender UiTM</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    margin: 0;
    background-color: #f4f6f9;
}

/* ===== HEADER ===== */
.header {
    background: #0b2e59;
    color: white;
    padding: 15px 30px;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}

/* ===== SIDEBAR ===== */
.sidebar {
    position: fixed;
    top: 70px;
    left: 0;
    width: 240px;
    height: calc(100vh - 70px);
    background: #1e1e2f;
    padding-top: 20px;
    overflow-y: auto;
}

.sidebar .nav-link {
    color: #ccc;
    padding: 10px 20px;
    display: block;
    transition: 0.2s;
}

.sidebar .nav-link:hover {
    background: #2c2c3c;
    color: white;
}

.sidebar .nav-link.active {
    background: #0d6efd;
    color: white;
}

/* ===== MAIN CONTENT ===== */
.main-content {
    margin-top: 70px;
    margin-left: 240px;
    padding: 30px;
    min-height: calc(100vh - 120px);
}

/* ===== FOOTER ===== */
.footer {
    background: #0b2e59;
    color: white;
    text-align: center;
    padding: 15px;
    margin-left: 240px;

}

/* ===== RESPONSIVE MOBILE ===== */
@media (max-width: 768px) {

    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        top: 0;
    }

    .main-content {
        margin-left: 0;
        padding: 20px;
    }

    .footer {
        margin-left: 0;
    }

}
</style>


</head>

<body>

<!-- ================= HEADER ================= -->
<div class="header d-flex justify-content-between align-items-center">

<div class="d-flex align-items-center">
    <img src="/my-tender/img/logo1.png" height="40" class="me-3">
    <h5 class="mb-0">MyTender Management System - UiTM</h5>
</div>

<div>
    <?php if (!empty($currentUser)): ?>
        Welcome, <?= h($currentUser['name'] ?? 'User') ?>
    <?php endif; ?>
</div>

</div>

<?php if (!empty($currentUser)): ?>

    
<!-- ================= SIDEBAR ================= -->
<div class="sidebar">

<?php if ($currentUser['role'] == 1): ?>
    <?= $this->element('admin_menu') ?>

<?php elseif ($currentUser['role'] == 2): ?>
    <?= $this->element('staff_menu') ?>

<?php elseif ($currentUser['role'] == 3): ?>
    <?= $this->element('vendor_menu') ?>

<?php endif; ?>

</div>

<?php endif; ?>

<!-- ================= MAIN CONTENT ================= -->
<div class="main-content">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>


<!-- Bootstrap JS  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- ================= FOOTER ================= -->
<div class="footer">
    © <?= date('Y') ?> Universiti Teknologi MARA (UiTM)  
    | MyTender System  
    | All Rights Reserved
</div>

</body>
</html>
