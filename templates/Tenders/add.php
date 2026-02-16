<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Add Tender</h3>

<?= $this->Form->create($tender) ?>

<div class="row">

<div class="col-md-6 mb-3">
    <?= $this->Form->control('title',['class'=>'form-control']) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('category_id',[
        'options'=>$categories,
        'class'=>'form-select'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('budget',[
        'type'=>'number',
        'step'=>'0.01',
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('closing_date',[
        'type'=>'date',
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-12 mb-3">
    <?= $this->Form->control('description',[
        'type'=>'textarea',
        'rows'=>4,
        'class'=>'form-control'
    ]) ?>
</div>

</div>

<hr>



<br>

<?= $this->Form->button('Save Tender', [
    'class'=>'btn btn-primary'
]) ?>

<?= $this->Form->end() ?>

</div>
</div>
