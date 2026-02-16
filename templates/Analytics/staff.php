<h2 class="fw-bold mb-4">Staff Performance Dashboard</h2>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card p-4 shadow-sm">
            <h6>Total Reviews</h6>
            <h2><?= $data['totalReviews'] ?? 0 ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 shadow-sm">
            <h6>Approved</h6>
            <h2 class="text-success"><?= $data['approved'] ?? 0 ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 shadow-sm">
            <h6>Rejected</h6>
            <h2 class="text-danger"><?= $data['rejected'] ?? 0 ?></h2>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card p-4 shadow-sm">
            <canvas id="reviewChart"></canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4 shadow-sm text-center">
            <h5>Performance Score</h5>
            <h1 class="text-primary"><?= $data['performanceScore'] ?? 0 ?>%</h1>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const reviewData = <?= json_encode($data['monthlyReviews'] ?? []) ?>;

new Chart(document.getElementById('reviewChart'), {
    type: 'line',
    data: {
        labels: reviewData.map(r => r.month + '/' + r.year),
        datasets: [{
            label: 'Reviews',
            data: reviewData.map(r => r.count),
            borderColor: '#0d6efd',
            tension: 0.3
        }]
    },
    options: { maintainAspectRatio: false }
});
</script>
