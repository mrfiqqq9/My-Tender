<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-3">Notification Detail</h3>

<table class="table table-bordered">

<tr>
    <th width="25%">Message</th>
    <td><?= h($notification->message) ?></td>
</tr>

<tr>
    <th>Status</th>
    <td>
        <?= $notification->is_read
            ? '<span class="badge bg-success">Read</span>'
            : '<span class="badge bg-warning text-dark">Unread</span>'
        ?>
    </td>
</tr>

<tr>
    <th>Date</th>
    <td><?= $notification->created_at->format('d/m/Y H:i') ?></td>
</tr>

</table>

<hr>

<?= $this->Html->link(
    '← Back to Notifications',
    ['action'=>'index'],
    ['class'=>'btn btn-outline-secondary']
) ?>

</div>
</div>
