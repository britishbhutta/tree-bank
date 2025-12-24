@extends('admin.layouts.master')
@section('title', 'Edit Donation')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        <h4 class="fw-bold mb-4 border-bottom pb-2">Edit Donation</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.donation.update', $donation->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>User</label>
                                    <select name="user_id" class="form-control" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $donation->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Project</label>
                                    <select name="project_id" id="project_id" class="form-control" required>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ $donation->project_id == $project->id ? 'selected' : '' }}>
                                                {{ $project->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Workshop</label>
                                    <select name="ws_id" id="ws_id" class="form-control">
                                        <option value="">Select Workshop</option>
                                        @foreach ($workshops as $ws)
                                            <option value="{{ $ws->id }}" data-project="{{ $ws->project_id }}"
                                                {{ $donation->ws_id == $ws->id ? 'selected' : '' }}>
                                                {{ $ws->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Type</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="Trees" {{ $donation->type == 'Trees' ? 'selected' : '' }}>Trees
                                        </option>
                                        <option value="Funds" {{ $donation->type == 'Funds' ? 'selected' : '' }}>Funds
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Fund Type</label>
                                    <select name="fund_type" id="fund_type" class="form-control"
                                        {{ $donation->type == 'Trees' ? 'disabled' : '' }}>
                                        <option value="">Select</option>
                                        <option value="Cash" {{ $donation->fund_type == 'Cash' ? 'selected' : '' }}>Cash
                                        </option>
                                        <option value="Cheque" {{ $donation->fund_type == 'Cheque' ? 'selected' : '' }}>
                                            Cheque</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Flow</label>
                                    <select name="flow" class="form-control" required>
                                        <option value="In" {{ $donation->flow == 'In' ? 'selected' : '' }}>In</option>
                                        <option value="Out" {{ $donation->flow == 'Out' ? 'selected' : '' }}>Out
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Amount</label>
                                    <input type="number" name="amount" class="form-control"
                                        value="{{ $donation->amount }}" required>
                                </div>
                            </div>

                            {{-- TREE SECTION --}}
                            <div id="tree-section" style="{{ $donation->type == 'Trees' ? '' : 'display:none' }}">
                                <hr>
                                <button type="button" class="btn btn-success btn-sm mb-3" id="add-tree-row">+ Add Tree
                                    Type</button>

                                <div id="tree-rows">
                                    @foreach ($trees as $tree)
                                        <div class="row mb-2 tree-row">
                                            <div class="col-md-6">
                                                <select name="trees[type_id][]" class="form-control" required>
                                                    <option value="">Select Tree</option>
                                                    @foreach ($treetype as $t)
                                                        <option value="{{ $t->id }}"
                                                            {{ (int) $t->id === (int) $tree['type_id'] ? 'selected' : '' }}>
                                                            {{ $t->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="number" name="trees[qty][]" class="form-control"
                                                    min="1" value="{{ $tree['qty'] }}" required>
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

    <script>
        const projectSelect = document.getElementById('project_id');
        const wsSelect = document.getElementById('ws_id');
        const type = document.getElementById('type');
        const fund = document.getElementById('fund_type');
        const treeSection = document.getElementById('tree-section');
        const rows = document.getElementById('tree-rows');

        document.addEventListener('DOMContentLoaded', () => filterWorkshops());
        projectSelect.addEventListener('change', filterWorkshops);

        function filterWorkshops() {
            const pid = projectSelect.value;
            Array.from(wsSelect.options).forEach(opt => {
                if (!opt.value) return;
                opt.style.display = opt.dataset.project == pid ? 'block' : 'none';
            });
        }

        type.addEventListener('change', () => {
            if (type.value === 'Trees') {
                treeSection.style.display = 'block';
                fund.disabled = true;
                fund.value = '';
            } else {
                treeSection.style.display = 'none';
                fund.disabled = false;
                rows.innerHTML = '';
            }
        });

        document.getElementById('add-tree-row').addEventListener('click', () => {
            rows.insertAdjacentHTML('beforeend', `
            <div class="row mb-2 tree-row">
            <div class="col-md-6">
            <select name="trees[type_id][]" class="form-control" required>
            <option value="">Select Tree</option>
            @foreach ($treetype as $t)
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

        document.addEventListener('click', e => {
            if (e.target.classList.contains('remove')) {
                e.target.closest('.tree-row').remove();
            }
        });
    </script>
@endsection
