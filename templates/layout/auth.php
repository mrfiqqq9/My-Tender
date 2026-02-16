<!DOCTYPE html>
<html>
<head>
<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login - MyTender UiTM</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body, html {
    height: 100%;
    margin: 0;
}

/* Background Slider */
.bg-slide {
    position: fixed;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    animation: slideBg 18s infinite;
    z-index: -1;
}

@keyframes slideBg {
    0%   { background-image: url('/my-tender/img/slider/uitm1.jpg'); }
    33%  { background-image: url('/my-tender/img/slider/uitm2.jpg'); }
    66%  { background-image: url('/my-tender/img/slider/uitm3.jpg'); }
    100% { background-image: url('/my-tender/img/slider/uitm3.webp'); }
}

/* Overlay gelap */
.overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
    z-index: -1;
}

/* Login Card */
.login-card {
    backdrop-filter: blur(15px);
    background: rgba(255,255,255,0.15);
    border-radius: 20px;
    padding: 40px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.4);
    color: white;
}


.brand-title {
    color: white;
    font-weight: 600;
    font-size: 28px;
}
.form-control {
    background: rgba(255,255,255,0.8);
}

</style>
</head>

<body>

<div class="bg-slide"></div>
<div class="overlay"></div>

<div class="container h-100 d-flex flex-column justify-content-center align-items-center">

    <div class="text-center mb-4">
        <h2 class="brand-title">MyTender Management System</h2>
        <p class="text-white">Universiti Teknologi MARA</p>
    </div>

    <div class="login-card">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
