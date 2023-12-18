<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">Удалить пользователя</x-slot>
    <x-slot name="text">Будет невозможно восстановить пользователя!</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.aside wire:model="displayData">
    <x-slot name="title">{{ $userId ? "Редактировать" : "Добавить" }} пользователя</x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $userId ? 'update' : 'store' }}" class="space-y-indent-half" id="dataForm">
            <div>
                <label for="name" class="inline-block mb-2">
                    Имя<span class="text-danger">*</span>
                </label>
                <input type="text" id="name" class="form-control"
                       required
                       wire:loading.attr="disabled"
                       wire:model="name">
            </div>

            <div>
                <label for="email" class="inline-block mb-2">
                    E-mail<span class="text-danger">*</span>
                </label>
                <input type="email" id="email" class="form-control"
                       required
                       wire:loading.attr="disabled"
                       wire:model="email">
            </div>

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeEdit">
                    Отмена
                </button>
                <button type="submit" form="dataForm" class="btn btn-primary"
                        wire:loading.attr="disabled">
                    Обновить
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.aside>
