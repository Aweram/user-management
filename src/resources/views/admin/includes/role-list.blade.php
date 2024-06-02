@foreach($roles as $item)
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ $item->name }}</h5>
        </div>
        <div class="card-body">
            Permissions
        </div>
    </div>
@endforeach

<div class="card">
    <div class="card-body">
        <div class="flex justify-between">
            <div>{{ __("Total") }}: {{ $roles->total() }}</div>
            {{ $roles->links("tt::pagination.live") }}
        </div>
    </div>
</div>
