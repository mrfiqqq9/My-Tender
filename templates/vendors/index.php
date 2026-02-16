<h2 class="mb-4">Vendor Management</h2>

<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-hover align-middle mb-0">
<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Company</th>
    <th>Email</th>
    <th>Experience</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php foreach ($vendors as $v): ?>
<tr>
    <td><?= h($v->vendor_id) ?></td>
    <td><?= h($v->company_name) ?></td>
    <td><?= h($v->user->email ?? '-') ?></td>
    <td><?= h($v->years_experience) ?> yrs</td>

    <td>
        <?php
        echo match ($v->vendor_status) {
            0 => '<span class="badge bg-warning text-dark">Pending</span>',
            1 => '<span class="badge bg-success">Approved</span>',
            2 => '<span class="badge bg-danger">Rejected</span>',
            3 => '<span class="badge bg-secondary">Suspended</span>',
        };
        ?>
    </td>

    <td>
        <?= $this->Html->link(
            'View',
            ['action'=>'view',$v->vendor_id],
            ['class'=>'btn btn-sm btn-outline-primary']
        ) ?>
    </td>
</tr>
<?php endforeach; ?>
</tbody>

</table>

</div>
</div>
