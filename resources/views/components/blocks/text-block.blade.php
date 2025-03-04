@props(['title', 'content', 'button_text'=>null, 'button_link'=>null])

<div class="container mx-auto py-10">
    <div class="row flex flex-col items-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold">{{ $title }}</h1>
            <p class="mt-4">{{ $content }}</p>
            @if($button_text && $button_link)
                <p class="mt-6">
                    <a href="{{ $button_link }}" class="btn btn-primary text-white bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded">{{ $button_text }}</a>
                </p>
            @endif
        </div>
    </div>
</div>
