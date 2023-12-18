<x-tt::table>
    <x-slot name="head">
        <tr>
            <x-tt::table.heading sortable
                                 wire:click="changeSort('name')"
                                 :direction="$sortBy == 'name' ? $sortDirection : null">
                Имя
            </x-tt::table.heading>
            <x-tt::table.heading sortable
                                 wire:click="changeSort('email')"
                                 :direction="$sortBy == 'email' ? $sortDirection : null">
                E-mail
            </x-tt::table.heading>
            <x-tt::table.heading>Действия</x-tt::table.heading>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($users as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    <div class="flex justify-center">
                        <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                                wire:loading.attr="disabled"
                                wire:click="showEdit({{ $item->id }})">
                            <x-tt::ico.edit />
                        </button>
                        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                @if ($item->id === Auth::id()) disabled @endif
                                wire:loading.attr="disabled"
                                wire:click="showDelete({{ $item->id }})">
                            <x-tt::ico.trash />
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
    <x-slot name="caption">
        <div class="flex justify-between">
            <div>Всего: {{ $users->total() }}</div>
            {{ $users->links("tt::pagination.live") }}
        </div>
    </x-slot>
</x-tt::table>
