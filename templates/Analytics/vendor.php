<h2 class="fw-bold mb-4">Vendor Performance Dashboard</h2>

<div class="row g-4 mb-4">

<div class="col-md-4">
<div class="card p-4 shadow-sm">
<h6>Total Applications</h6>
<h2><?= $data['totalApplications'] ?? 0 ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-4 shadow-sm">
<h6>Approval Rate</h6>
<h2 class="text-success"><?= $data['approvalRate'] ?? 0 ?>%</h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-4 shadow-sm">
<h6>Total Revenue</h6>
<h2 class="text-primary">
RM <?= number_format($data['totalRevenue'] ?? 0,2) ?>
</h2>
</div>
</div>

</div>

<div class="card p-4 shadow-sm">
<canvas id="vendorTrend"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const vendorData = <?= json_encode($data['monthlyApplications'] ?? []) ?>;

new Chart(document.getElementById('vendorTrend'), {
    type: 'line',
    data: {
        labels: vendorData.map(r => r.month + '/' + r.year),
        datasets: [{
            label: 'Applications',
            data: vendorData.map(r => r.count),
            borderColor: '#198754',
            tension: 0.3
        }]
    },
    options: { maintainAspectRatio: false }
});
</script>
