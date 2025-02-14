<div class="container mx-auto py-5 new-items">
    <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">{{$this->title}}</h2>
    </div>
    <div class="grid gap-6 mt-6 justify-center items-center
        @if($amount == 1) grid-cols-1
        @elseif($amount == 2) sm:grid-cols-2
        @elseif($amount == 3) md:grid-cols-3
        @elseif($amount == 4) lg:grid-cols-4
        @elseif($amount == 5) xl:grid-cols-5
        @endif">
        @foreach($advertisements as $advertisement)
            @livewire('shop-item', ['advertisement' => $advertisement], key('advertisement-'.$advertisement->id))
        @endforeach
    </div>
    @if($this->link !== null && $this->linkText !== null)
        <div class="text-center mt-8">
            <p><a href="{{$this->link}}" class="btn btn-outline-dark text-xl py-3 px-6 rounded-md transition duration-300 ease-in-out hover:bg-gray-800 hover:text-white">{{$this->linkText}}</a></p>
        </div>
    @endif
</div>
