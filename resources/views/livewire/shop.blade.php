<div>
    <x-hero />
    <div class="container mx-auto px-4 py-8">
        <div class="col-6 p-0">
            <div class="float-end d-flex sorting gap-3">
                <select class="form-select shadow-none" wire:model.live="sorting">
                    <option value="newest">New to old</option>
                    <option value="oldest">Old to New</option>
                    <option value="highlow">High to low</option>
                    <option value="lowhigh">Low to high</option>
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
        <div class="mt-4">
            {{ $advertisements->links() }}
        </div>
    </div>
</div>
