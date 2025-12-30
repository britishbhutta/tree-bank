@forelse($trees as $tree)
<tr>
    <td>{{ $tree->id }}</td>
    <td>{{ $tree->treeTypes->name ?? '-' }}</td>
    <td>{{ $tree->projects->name ?? '-' }}</td>
    <td>
        @if($tree->planting_status)
            <span class="badge bg-success">Yes</span>
        @else
            <span class="badge bg-danger">No</span>
        @endif
    </td>
    <td>
        <a href="{{ route('admin.trees.show',$tree->id) }}"
           class="btn btn-info btn-sm">
            View
        </a>
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center">No Trees Found</td>
</tr>
@endforelse
