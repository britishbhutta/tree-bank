@forelse($trees as $tree)
    <tr>
        <td>{{ $tree->id }}</td>
        <td>{{ $tree->treeTypes->name ?? '-' }}</td>
        <td>{{ $tree->treeName->name ?? '-' }}</td>
        <td>{{ $tree->projects->name ?? '-' }}</td>
        <td>
            @if ($tree->planting_status)
                <span class="badge bg-success">Yes</span>
            @else
                <span class="badge bg-danger">No</span>
            @endif
        </td>
        <td>
            @if ($tree->death === 1)
                <span class="badge bg-danger">Dead</span>
            @elseif ($tree->death === 0)
                <span class="badge bg-success">Alive</span>
            @else
                <span class="badge bg-secondary">N/A</span>
            @endif

        </td>

        <td>
            <a href="{{ route('admin.trees.show', $tree->id) }}" class="btn btn-info btn-sm">
                View
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">No Trees Found</td>
    </tr>
@endforelse
