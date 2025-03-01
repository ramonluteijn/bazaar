<div>
    <x-blocks.hero />
    <div class="container mx-auto px-4 py-8">
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

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @if($advertisements->isEmpty())
                <p>No advertisements found.</p>
            @else
                @foreach($advertisements as $advertisement)
                    @livewire('shop-item', ['advertisement' => $advertisement], key('advertisement-'.$advertisement->id))
                @endforeach
            @endif
        </div>
    </div>
</div>
