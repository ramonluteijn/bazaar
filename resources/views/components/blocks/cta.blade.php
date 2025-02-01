@props(['title'=>null, 'content'=>null, 'button_text'=>null, 'button_link'=>null, 'image'=>null, 'video'=>null, 'background'=>null])

<div>
     <div class="w-full text-center p-10" style="background-color: {{$background}}">
        <p class="text-center text-6xl">{{$title}}</p>
        <br>
        <h2 class="text-center text-4xl">{{$content}}</h2>
        <br>
        @if($button_text && $button_link)
            <a class="text-center" href="{{$button_link}}">{{$button_text}}</a>
        @endif
    </div>
</div>
