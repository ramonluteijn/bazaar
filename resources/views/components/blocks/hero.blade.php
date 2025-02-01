@props(['title'=>null, 'button_text'=>null, 'button_link'=>null, 'image'=>null, 'background'=>null])

<?php
    if($image !== null){
        $background = "background: url('asset($image)')";
    }
    if($background !== null){
        $background = "background-color: $background";
    }
?>

<div class="w-full h-[400px]" style="{{$background}}">
    <div class="container mx-auto h-full relative">
        <div class="row absolute inset-x-0 bottom-[100px]">
            <div class="col-12 text-center">
                <h1 class="text-7xl font-medium">{{$title == null ? config('app.name') : $title}}</h1>
                @if($button_link !== null && $button_text !== null)
                    <a href="{{$button_link}}" class="">{{$button_text}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
