<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">Удалить пользователя</x-slot>
    <x-slot name="text">Будет невозможно восстановить пользователя!</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.aside wire:model="displayEdit">
    <x-slot name="title">Редактировать пользователя</x-slot>
    <x-slot name="content">
        {{ $name }}: {{ $email }}
    </x-slot>
</x-tt::modal.aside>
