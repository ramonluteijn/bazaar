@props(['title'=>null, 'content'=>null, 'button_text'=>null, 'button_link'=>null, 'image'=>null])

<div class="w-full text-center p-10 {{ $image ? 'bg-cover bg-center' : 'bg-gray-300' }}" style="{{ $image ? "background-image: url('".asset($image)."')" : '' }}">
    <p class="text-center text-6xl">{{ $title }}</p>
    <br>
    <h2 class="text-center text-4xl">{{ $content }}</h2>
    <br>
    @if($button_text && $button_link)
        <a class="text-center text-blue-500 hover:text-blue-700" href="{{ $button_link }}">{{ $button_text }}</a>
    @endif
</div>
