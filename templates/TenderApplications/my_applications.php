<h2 class="mb-4">My Applications</h2>

<div class="row g-3 mb-4">

<div class="col-md-3">
<div class="card text-center shadow-sm border-primary">
<div class="card-body">
<h6>Total</h6>
<h4><?= $total ?></h4>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center shadow-sm border-warning">
<div class="card-body">
<h6>Pending</h6>
<h4><?= $pending ?></h4>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center shadow-sm border-success">
<div class="card-body">
<h6>Approved</h6>
<h4><?= $approved ?></h4>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center shadow-sm border-danger">
<div class="card-body">
<h6>Rejected</h6>
<h4><?= $rejected ?></h4>
</div>
</div>
</div>

</div>

<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-striped align-middle mb-0">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Tender</th>
<th>Price</th>
<th>Status</th>
<th>Applied At</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php foreach ($applications as $app): ?>
<tr>
<td><?= $app->application_id ?></td>
<td><?= h($app->tender->title ?? '-') ?></td>
<td>RM <?= number_format($app->proposed_price,2) ?></td>

<td>
<?= match ($app->status) {
    0 => '<span class="badge bg-warning text-dark">Pending</span>',
    1 => '<span class="badge bg-success">Approved</span>',
    2 => '<span class="badge bg-danger">Rejected</span>',
} ?>
</td>

<td><?= $app->applied_at?->format('d/m/Y H:i') ?></td>

<td>
<?= $this->Html->link(
    'View',
    ['action'=>'view',$app->application_id],
    ['class'=>'btn btn-sm btn-outline-primary']
) ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>
