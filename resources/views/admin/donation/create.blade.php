@extends('admin.layouts.master')
@section('title', 'Add Donation')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    <h4 class="fw-bold mb-4 border-bottom pb-2">Add Donation</h4>

                    {{-- Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Success --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.donation.store') }}">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Donation Number</label>
                                <input type="text" class="form-control" value="{{ $donationNumber }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Donor</label>
                                <select name="user_id" class="form-control">
                                    <option value="">Select Donor</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Project</label>
                                <select name="project_id" id="project_id" class="form-control">
                                    <option value="">Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Workshop</label>
                                <select name="ws_id" id="ws_id" class="form-control" disabled>
                                    <option value="">Select Workshop</option>
                                    @foreach ($workshops as $workshop)
                                        <option value="{{ $workshop->id }}"
                                            data-project="{{ $workshop->project_id }}"
                                            {{ old('ws_id') == $workshop->id ? 'selected' : '' }}>
                                            {{ $workshop->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Type</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Trees" {{ old('type') == 'Trees' ? 'selected' : '' }}>Trees</option>
                                    <option value="Funds" {{ old('type') == 'Funds' ? 'selected' : '' }}>Funds</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Fund Type</label>
                                <select id="fund_type" name="fund_type" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Flow</label>
                                <select id="flow" name="flow" class="form-control">
                                    <option value="">Select</option>
                                    <option value="In">In</option>
                                    <option value="Out">Out</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Amount</label>
                                <input type="number" name="amount" class="form-control">
                            </div>

                        </div>

                        {{-- TREE SECTION --}}
                        <div id="tree-section" style="display:none">
                            <hr>
                            <div class="row mb-4" id="available-tree-cards"></div>
                            <button type="button"
                                    class="btn btn-success btn-sm mb-3"
                                    id="add-tree-row">
                                + Add Tree Type
                            </button>

                            <div id="tree-rows"></div>
                        </div>

                        <button class="btn btn-primary mt-3">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</main>

{{-- STYLES --}}
<style>
.tree-card{
    border:1px solid #ddd;
    border-radius:8px;
    padding:12px;
    background:#f8f9fa;
}
.tree-card h6{
    margin:0;
    font-weight:600;
}
.tree-card span{
    font-size:14px;
    color:#555;
}
</style>

{{-- SCRIPT --}}
<script>
const typeSelect     = document.getElementById('type');
const fundTypeSelect = document.getElementById('fund_type');
const flowSelect     = document.getElementById('flow');
const projectSelect  = document.getElementById('project_id');
const wsSelect       = document.getElementById('ws_id');
const treeSection    = document.getElementById('tree-section');
const treeRows       = document.getElementById('tree-rows');
const addTreeBtn     = document.getElementById('add-tree-row');
const cardsContainer = document.getElementById('available-tree-cards');
const amountInput    = document.querySelector('input[name="amount"]');
const amountLabel    = amountInput.previousElementSibling;

// PROJECT → WORKSHOP FILTER
projectSelect.addEventListener('change', () => {
    wsSelect.disabled = !projectSelect.value;

    [...wsSelect.options].forEach(opt => {
        if (!opt.value) return;
        opt.style.display =
            opt.dataset.project == projectSelect.value ? 'block' : 'none';
    });
});

// TYPE CHANGE (Trees / Funds)
function handleTypeChange() {
    if (typeSelect.value === 'Trees') {
        treeSection.style.display = 'block';
        fundTypeSelect.disabled = true;
        fundTypeSelect.value = '';
        amountLabel.textContent = 'Quantity';       
        amountInput.placeholder = 'Enter quantity';    
    } else if (typeSelect.value === 'Funds') {
        treeSection.style.display = 'none';
        treeRows.innerHTML = '';
        cardsContainer.innerHTML = '';
        fundTypeSelect.disabled = false;
        amountLabel.textContent = 'Amount';          
        amountInput.placeholder = 'Enter amount';     
    } else {
        treeSection.style.display = 'none';
        fundTypeSelect.disabled = true;
        fundTypeSelect.value = '';
        amountLabel.textContent = 'Amount';
        amountInput.placeholder = '';
    }
}

// FLOW CHANGE (OUT trees)
function handleFlowChange() {
    if (typeSelect.value === 'Trees' && flowSelect.value === 'Out') {
        loadAvailableTrees();
    } else {
        cardsContainer.innerHTML = '';
    }
}

// LOAD AVAILABLE TREES (OUT)
async function loadAvailableTrees() {
    cardsContainer.innerHTML = '';
    if (flowSelect.value !== 'Out' || !projectSelect.value) return;

    const res  = await fetch(`/admin/trees/available?project_id=${projectSelect.value}`);
    const data = await res.json();

    if (!data.length) {
        cardsContainer.innerHTML = `<div class="col-12 text-danger">No trees available</div>`;
        return;
    }

    data.forEach(tree => {
        cardsContainer.insertAdjacentHTML('beforeend', `
            <div class="col-md-4 mb-3">
                <div class="tree-card">
                    <h6>${tree.name}</h6>
                    <span>Available: <strong>${tree.qty}</strong></span>
                </div>
            </div>
        `);
    });
}

// ADD TREE ROW
addTreeBtn.addEventListener('click', () => {
    treeRows.insertAdjacentHTML('beforeend', `
        <div class="row mb-2 tree-row">
            <div class="col-md-6">
                <label>Tree Type</label>
                <select name="trees[type_id][]" class="form-control" required>
                    <option value="">Select Tree Type</option>
                    @foreach ($treetype as $tree)
                        <option value="{{ $tree->id }}">{{ $tree->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Quantity</label>
                <input type="number" name="trees[qty][]" class="form-control" min="1" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove">×</button>
            </div>
        </div>
    `);
});

// REMOVE TREE ROW
document.addEventListener('click', e => {
    if (e.target.classList.contains('remove')) {
        e.target.closest('.tree-row').remove();
    }
});

// EVENTS
typeSelect.addEventListener('change', handleTypeChange);
flowSelect.addEventListener('change', handleFlowChange);
projectSelect.addEventListener('change', handleFlowChange);

document.addEventListener('DOMContentLoaded', () => {
    handleTypeChange();
    handleFlowChange();
});
</script>
@endsection
