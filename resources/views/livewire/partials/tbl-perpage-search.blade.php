<div class="col form-inline small">
    <select wire:model="perPage" class="form-control form-control-sm">
        <option>5</option>
        <option selected>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
    </select>
</div>

<div class="col">
    <span wire:loading wire:target="search" class="text-success">Searching... <i
            class="fas fa-spinner fa-spin"></i></span>
    <span wire:loading wire:target="perPage" class="text-success">Data per page... <i
            class="fas fa-spinner fa-spin"></i></span>
    <span wire:loading wire:target="sortBy" class="text-success">Shorting... <i
            class="fas fa-spinner fa-spin"></i></span>
    <span wire:loading.delay class="text-success">Loading... <i
            class="fas fa-spinner fa-spin"></i></span>
</div>

<div class="col">
    <input wire:model.debounce.300ms="search" class="form-control form-control-sm" type="text"
        placeholder="Search by any data at the table...">
</div>