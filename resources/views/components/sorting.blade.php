<div class="col-6 p-0">
    <div class="float-end d-flex sorting gap-3">
        <select class="form-select shadow-none" wire:model.live="sortOrder">
            <option value="new_to_old">{{__('New to old')}}</option>
            <option value="old_to_new">{{__('Old to new')}}</option>
            <option value="high_to_low">{{__('High to low')}}</option>
            <option value="low_to_high">{{__('Low to high')}}</option>
        </select>
    </div>
</div>
