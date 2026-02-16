<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">News Management</h2>

    <?= $this->Html->link(
        '➕ Add News',
        ['action' => 'add'],
        ['class' => 'btn btn-primary']
    ) ?>
</div>

<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-striped table-hover align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Tender</th>
            <th>Status</th>
            <th>Created</th>
            <th>Image</th>
            <th width="180">Action</th>
        </tr>
    </thead>
    <tbody>

<?php foreach ($news as $n): ?>
<tr>
    <td><?= $n->news_id ?></td>

    <td><?= h($n->title) ?></td>

    <td><?= h($n->tender->title ?? '-') ?></td>

    <td>
        <?= $n->status
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-secondary">Hidden</span>'
        ?>
    </td>

    <td><?= $n->created_at->format('d/m/Y') ?></td>

    <td>
        <?php if ($n->image): ?>
            <img src="<?= $this->Url->image('img/news/' . $n->image) ?>"
                 class="img-thumbnail"
                 style="width:70px;height:60px;object-fit:cover;">
        <?php else: ?>
            -
        <?php endif; ?>
    </td>

    <td>
        <?= $this->Html->link(
            'View',
            ['action'=>'view',$n->news_id],
            ['class'=>'btn btn-sm btn-outline-primary']
        ) ?>

        <?= $this->Html->link(
            'Edit',
            ['action'=>'edit',$n->news_id],
            ['class'=>'btn btn-sm btn-outline-success']
        ) ?>

        <?= $this->Form->postLink(
            'Delete',
            ['action'=>'delete',$n->news_id],
            [
                'confirm'=>'Delete this news?',
                'class'=>'btn btn-sm btn-outline-danger'
            ]
        ) ?>
    </td>
</tr>
<?php endforeach; ?>

<?php if ($news->count() === 0): ?>
<tr>
    <td colspan="7" class="text-center p-4">
        No news found.
    </td>
</tr>
<?php endif; ?>

    </tbody>
</table>

</div>
</div>
