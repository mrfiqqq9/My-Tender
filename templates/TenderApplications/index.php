<h2 class="mb-4">Tender Applications</h2>

<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-hover align-middle mb-0">
<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Tender</th>
    <th>Vendor</th>
    <th>Price</th>
    <th>Status</th>
    <th>Applied At</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php foreach ($applications as $app): ?>
<tr>
    <td><?= h($app->application_id) ?></td>
    <td><?= h($app->tender->title ?? '-') ?></td>
    <td><?= h($app->vendor->company_name ?? '-') ?></td>
    <td>RM <?= number_format($app->proposed_price, 2) ?></td>

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
