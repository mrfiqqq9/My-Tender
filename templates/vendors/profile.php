<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-3">My Vendor Profile</h3>

<p><strong>Company:</strong> <?= h($vendor->company_name) ?></p>

<p>
<strong>Status:</strong>
<?= match ($vendor->vendor_status) {
    0 => '<span class="badge bg-warning text-dark">Pending</span>',
    1 => '<span class="badge bg-success">Approved</span>',
    2 => '<span class="badge bg-danger">Rejected</span>',
    3 => '<span class="badge bg-secondary">Suspended</span>'
} ?>
</p>

<p><strong>Category:</strong> <?= h($vendor->category->category_name ?? '-') ?></p>

<p><strong>Description:</strong><br>
<?= nl2br(h($vendor->description)) ?>
</p>

<p><strong>Address:</strong><br>
<?= h($vendor->address_line1) ?><br>
<?= h($vendor->city) ?>, <?= h($vendor->state) ?>
</p>

<?= $this->Html->link(
    'Edit Profile',
    ['action'=>'editProfile'],
    ['class'=>'btn btn-primary']
) ?>

</div>
</div>
