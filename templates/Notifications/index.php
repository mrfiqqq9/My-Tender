<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Notifications</h2>
</div>

<?php if ($notifications->count() === 0): ?>

<div class="card shadow-sm">
<div class="card-body text-center p-5">
    <h5 class="text-muted">No notifications available</h5>
</div>
</div>

<?php else: ?>

<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-hover align-middle mb-0">
<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Message</th>
    <th>Status</th>
    <th>Date</th>
    <th width="120">Action</th>
</tr>
</thead>

<tbody>

<?php foreach ($notifications as $n): ?>
<tr class="<?= $n->is_read ? '' : 'table-warning' ?>">

    <td><?= $n->notification_id ?></td>

    <td>
        <?= h($n->message) ?>
        <?php if (!$n->is_read): ?>
            <span class="badge bg-danger ms-2">New</span>
        <?php endif; ?>
    </td>

    <td>
        <?= $n->is_read
            ? '<span class="badge bg-success">Read</span>'
            : '<span class="badge bg-warning text-dark">Unread</span>'
        ?>
    </td>

    <td><?= $n->created_at->format('d/m/Y H:i') ?></td>

    <td>
        <?= $this->Html->link(
            'View',
            ['action'=>'view',$n->notification_id],
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
