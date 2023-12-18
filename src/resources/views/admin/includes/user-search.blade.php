<div class="flex justify-between mb-indent-half">
    <div class="flex space-x-indent-half">
        <input type="text" aria-label="Имя" placeholder="Имя" id="name" class="form-control" wire:model.live="searchName">
        <input type="text" aria-label="E-mail" placeholder="E-mail" id="email" class="form-control" wire:model.live="searchEmail">
        <button type="button" class="btn btn-outline-primary" wire:click="clearSearch">Сбросить</button>
    </div>
    <div>
        <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x"
                wire:click="showCreate">
            <x-tt::ico.circle-plus />
            <span class="hidden lg:inline-block pl-btn-ico-text">Добавить</span>
        </button>
    </div>
</div>
