<div class="card shadow-sm">
<div class="card-body">

<h2 class="mb-3"><?= h($news->title) ?></h2>

<?php if ($news->image): ?>
    <img src="<?= $this->Url->image('img/news/' . $news->image) ?>"
         class="img-fluid rounded mb-4"
         style="max-height:300px;object-fit:cover;">
<?php endif; ?>

<p class="text-muted">
    <strong>Status:</strong>
    <?= $news->status
        ? '<span class="badge bg-success">Active</span>'
        : '<span class="badge bg-secondary">Hidden</span>'
    ?>
</p>

<p class="text-muted">
    <strong>Created:</strong>
    <?= $news->created_at->format('d/m/Y H:i') ?>
</p>

<hr>

<h5>Description</h5>
<p><?= nl2br(h($news->description)) ?></p>

<hr>

<?= $this->Html->link(
    '← Back',
    ['action'=>'index'],
    ['class'=>'btn btn-outline-secondary']
) ?>

</div>
</div>
