@props(['title'=>null, 'button_text'=>null, 'button_link'=>null, 'image'=>null])

<?php
    if($image !== null){
        $background = "background: url('asset($image)')";
    }else{
        $background = "background-color: #c1bebe";
    }
?>

@props(['title'=>null, 'button_text'=>null, 'button_link'=>null, 'image'=>null])

<div class="w-full h-[400px] {{ $image ? 'bg-cover bg-center' : 'bg-gray-300' }}" style="{{ $image ? "background-image: url('".asset($image)."')" : '' }}">
    <div class="container mx-auto h-full relative">
        <div class="row absolute inset-x-0 bottom-[100px]">
            <div class="col-12 text-center">
                <h1 class="text-7xl font-medium">{{ $title == null ? config('app.name') : $title }}</h1>
                @if($button_link !== null && $button_text !== null)
                    <a href="{{ $button_link }}" class="text-blue-500 hover:text-blue-700">{{ $button_text }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
