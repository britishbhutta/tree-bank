@extends('admin.layouts.master')
@section('title','Edit Donation')

@section('content')
<main class="content-page">
<div class="content mt-4">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<h4 class="fw-bold mb-4 border-bottom pb-2">Edit Donation</h4>

@if($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form method="POST" action="{{ route('admin.donation.update',$donation->id) }}">
@csrf
@method('PUT')

<div class="row">
<div class="col-md-6 mb-3">
<label>User</label>
<select name="user_id" class="form-control" required>
@foreach($users as $user)
<option value="{{ $user->id }}" {{ $donation->user_id==$user->id ? 'selected':'' }}>
{{ $user->name }}
</option>
@endforeach
</select>
</div>

<div class="col-md-6 mb-3">
<label>Project</label>
<select name="project_id" id="project_id" class="form-control" required>
<option value="">Select Project</option>
@foreach($projects as $project)
<option value="{{ $project->id }}"
{{ $selectedProjectId == $project->id ? 'selected' : '' }}>
{{ $project->name }}
</option>
@endforeach
</select>

</div>

<div class="col-md-6 mb-3">
<label>Workshop</label>
<select name="ws_id" id="ws_id" class="form-control">
<option value="">Select Workshop</option>
@foreach($workshops as $ws)
<option value="{{ $ws->id }}" data-project="{{ $ws->project_id }}" {{ $donation->ws_id==$ws->id ? 'selected':'' }}>
{{ $ws->name }}
</option>
@endforeach
</select>
</div>

<div class="col-md-6 mb-3">
<label>Type</label>
<select name="type" id="type" class="form-control" required>
<option value="Trees" {{ $donation->type=='Trees'?'selected':'' }}>Trees</option>
<option value="Funds" {{ $donation->type=='Funds'?'selected':'' }}>Funds</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Fund Type</label>
<select name="fund_type" id="fund_type" class="form-control" {{ $donation->type=='Trees'?'disabled':'' }}>
<option value="">Select</option>
<option value="Cash" {{ $donation->fund_type=='Cash'?'selected':'' }}>Cash</option>
<option value="Cheque" {{ $donation->fund_type=='Cheque'?'selected':'' }}>Cheque</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Flow</label>
<select name="flow" id="flow" class="form-control" required>
<option value="In" {{ $donation->flow=='In'?'selected':'' }}>In</option>
<option value="Out" {{ $donation->flow=='Out'?'selected':'' }}>Out</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Amount</label>
<input type="number" name="amount" class="form-control" value="{{ $donation->amount }}" required>
</div>
</div>

<div id="tree-section" style="{{ $donation->type=='Trees'?'':'display:none' }}">
<hr class="my-2">
<div id="available-tree-cards" class="tree-grid"></div>

<button type="button" class="btn btn-success btn-sm mb-3" id="add-tree-row">+ Add Tree Type</button>

<div id="tree-rows">
@foreach($trees as $tree)
<div class="row mb-2 tree-row">
<div class="col-md-6">
<select name="trees[type_id][]" class="form-control" required>
<option value="">Select Tree</option>
@foreach($treetype as $t)
<option value="{{ $t->id }}" {{ $t->id==$tree['type_id']?'selected':'' }}>{{ $t->name }}</option>
@endforeach
</select>
</div>
<div class="col-md-4">
<input type="number" name="trees[qty][]" class="form-control" min="1" value="{{ $tree['qty'] }}" required>
</div>
<div class="col-md-2">
<button type="button" class="btn btn-danger remove">×</button>
</div>
</div>
@endforeach
</div>
</div>

<button class="btn btn-primary mt-3">Update Donation</button>
</form>

</div>
</div>
</div>
</div>
</main>

<style>
.tree-grid{
display:flex;
flex-wrap:wrap;
gap:12px;
margin-bottom:15px;
}
.tree-card{
width:160px;
padding:12px;
border-radius:10px;
background:linear-gradient(135deg,#f8f9fa,#eef1f4);
border:1px solid #dee2e6;
box-shadow:0 2px 6px rgba(0,0,0,.06);
transition:.2s;
}
.tree-card:hover{
transform:translateY(-2px);
box-shadow:0 4px 10px rgba(0,0,0,.1);
}
.tree-name{
font-weight:600;
font-size:14px;
margin-bottom:6px;
}
.tree-qty{
font-size:13px;
color:#555;
}
.tree-qty span{
font-weight:700;
color:#198754;
}
</style>

<script>
// Grab elements
const projectSelect = document.getElementById('project_id');
const wsSelect = document.getElementById('ws_id');
const typeSelect = document.getElementById('type');
const fundType = document.getElementById('fund_type');
const flowSelect = document.getElementById('flow');
const treeSection = document.getElementById('tree-section');
const treeRows = document.getElementById('tree-rows');
const addTreeBtn = document.getElementById('add-tree-row');
const cardsContainer = document.getElementById('available-tree-cards');
const donationId = "{{ $donation->id }}";

const amountInput = document.querySelector('input[name="amount"]');
const amountLabel = amountInput.previousElementSibling;

// PROJECT → WORKSHOP filter
function filterWorkshops() {
    const pid = projectSelect.value;
    Array.from(wsSelect.options).forEach(opt => {
        if (!opt.value) return;
        opt.style.display = opt.dataset.project == pid ? 'block' : 'none';
    });
}
projectSelect.addEventListener('change', filterWorkshops);
document.addEventListener('DOMContentLoaded', filterWorkshops);

// TYPE → Tree/Fund changes
function handleTypeChange() {
    if (typeSelect.value === 'Trees') {
        treeSection.style.display = 'block';
        fundType.disabled = true;
        fundType.value = '';
        amountLabel.textContent = 'Quantity';
        amountInput.placeholder = 'Enter quantity';
    } else if (typeSelect.value === 'Funds') {
        treeSection.style.display = 'none';
        treeRows.innerHTML = '';
        cardsContainer.innerHTML = '';
        fundType.disabled = false;
        amountLabel.textContent = 'Amount';
        amountInput.placeholder = 'Enter amount';
    } else {
        treeSection.style.display = 'none';
        fundType.disabled = true;
        fundType.value = '';
        amountLabel.textContent = 'Amount';
        amountInput.placeholder = '';
    }
}
typeSelect.addEventListener('change', handleTypeChange);
document.addEventListener('DOMContentLoaded', handleTypeChange);

// LOAD available trees (OUT)
async function loadAvailableTrees() {
    cardsContainer.innerHTML = '';
    if (flowSelect.value !== 'Out' || typeSelect.value !== 'Trees') return;
    if (!projectSelect.value) return;

    const res = await fetch(`/admin/trees/available?project_id=${projectSelect.value}&donation_id=${donationId}`);
    const data = await res.json();
    if (!data.length) {
        cardsContainer.innerHTML = `<div class="text-danger">No trees available</div>`;
        return;
    }

    data.forEach(tree => {
        cardsContainer.insertAdjacentHTML('beforeend', `
        <div class="tree-card">
            <div class="tree-name">${tree.name}</div>
            <div class="tree-qty">Available: <span>${tree.qty}</span></div>
        </div>
        `);
    });
}

[typeSelect, flowSelect].forEach(el => el.addEventListener('change', loadAvailableTrees));
document.addEventListener('DOMContentLoaded', loadAvailableTrees);

// ADD tree row
addTreeBtn.addEventListener('click', () => {
    treeRows.insertAdjacentHTML('beforeend', `
    <div class="row mb-2 tree-row">
        <div class="col-md-6">
            <select name="trees[type_id][]" class="form-control" required>
                <option value="">Select Tree</option>
                @foreach($treetype as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" name="trees[qty][]" class="form-control" min="1" required>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger remove">×</button>
        </div>
    </div>
    `);
});

// REMOVE tree row
document.addEventListener('click', e => {
    if (e.target.classList.contains('remove')) {
        e.target.closest('.tree-row').remove();
    }
});
</script>

@endsection
