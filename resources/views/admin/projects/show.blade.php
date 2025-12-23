@extends('admin.layouts.master')

@section('title','Project Detail')

@section('content')
<main class="content-page">
<div class="content mt-4">
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4>{{ $project->name }}</h4>
            <p>{{ $project->description }}</p>

            <p><strong>Start:</strong> {{ $project->start_date }}</p>
            <p><strong>End:</strong> {{ $project->end_date }}</p>

            <p>
                <strong>Status:</strong>
                @if($project->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </p>
        </div>
    </div>
</div>
</div>
</main>
@endsection
