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
                <td></td>
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
