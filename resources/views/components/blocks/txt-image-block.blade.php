@props(['title', 'content', 'image'=>null])

<div class="container mx-auto py-10">
    <div class="flex flex-wrap items-stretch justify-end w-full">
        <div class="w-full md:w-1/2 p-4">
            <h1 class="text-4xl font-bold">{{ $title }}</h1>
            <p class="mt-4">{{ $content }}</p>
        </div>
        <div class="w-full md:w-1/2 p-4">
            <div class="flex justify-start h-full w-full">
                @if($image != null)
                    <img src="{{ asset($image) }}" class="object-cover w-full h-full">
                @endif
            </div>
        </div>
    </div>
</div>
