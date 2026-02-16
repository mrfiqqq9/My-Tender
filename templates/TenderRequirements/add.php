<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Add Requirement</h3>

<?= $this->Form->create($requirement) ?>

<div class="row">

<div class="col-md-6 mb-3">
    <?= $this->Form->control('requirement_type', [
        'type'=>'select',
        'options'=>\App\Model\Entity\TenderRequirement::TYPES,
        'empty'=>'-- Select Requirement --',
        'required'=>true,
        'id'=>'requirement-type',
        'class'=>'form-select'
    ]) ?>
</div>

<div class="col-md-6 mb-3" id="value-wrapper">
    <?= $this->Form->control('requirement_value', [
        'label'=>'Value (if applicable)',
        'required'=>false,
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-12 mb-3">
    <?= $this->Form->control('description', [
        'type'=>'textarea',
        'rows'=>3,
        'label'=>'Description / Notes',
        'required'=>false,
        'class'=>'form-control'
    ]) ?>
</div>

</div>

<div class="mt-3">
    <?= $this->Form->button('Save Requirement', [
        'class'=>'btn btn-primary'
    ]) ?>

    <?= $this->Html->link(
        'Cancel',
        ['action'=>'index',$tenderId],
        ['class'=>'btn btn-secondary ms-2']
    ) ?>
</div>

<?= $this->Form->end() ?>

</div>
</div>

<script>
const typesRequiringValue = <?= json_encode(
    \App\Model\Entity\TenderRequirement::TYPES_REQUIRING_VALUE
) ?>;

const typeSelect = document.getElementById('requirement-type');
const valueWrapper = document.getElementById('value-wrapper');

function toggleValue() {
    const selected = parseInt(typeSelect.value);
    valueWrapper.style.display =
        typesRequiringValue.includes(selected) ? 'block' : 'none';
}

typeSelect.addEventListener('change', toggleValue);
toggleValue();
</script>
