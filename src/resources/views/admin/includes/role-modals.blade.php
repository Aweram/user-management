<x-tt::modal.aside wire:model="displayData">
    <x-slot name="title">{{ $roleId ? __("Edit role") : __("Add role") }}</x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $roleId ? 'update' : 'store' }}"
              class="space-y-indent-half" id="dataForm">
            <div>
                <label for="name" class="inline-block mb-2">
                    {{ __("Name") }}<span class="text-danger">*</span>
                </label>
                <input type="text" id="name"
                       class="form-control {{ $errors->has("name") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="name">
                <x-tt::form.error name="name" />
            </div>

            <div>
                <label for="title" class="inline-block mb-2">
                    {{ __("Title") }}<span class="text-danger">*</span>
                </label>
                <input type="text" id="title"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title" />
            </div>

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    {{ __("Cancel") }}
                </button>
                <button type="submit" form="dataForm" class="btn btn-primary"
                        wire:loading.attr="disabled">
                    {{ $roleId ? __("Update") : __("Add") }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.aside>
