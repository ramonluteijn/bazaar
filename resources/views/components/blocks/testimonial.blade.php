@props(['title', 'content', 'author', 'button_text'=>null, 'site_link'=>null])
<div class="text-center">
    <h2 class="title">{{$title}}</h2>
    <p class="text">{{$content}}</p>
    @if($button_text && $site_link)
        <p class="text-end link"><a href="{{$site_link}}" class="">{{$button_text}}</a></p>
    @endif
    <p class="author text-end">{{$author}}</p>
</div>
