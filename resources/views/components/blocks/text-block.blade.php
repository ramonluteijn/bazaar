@props(['title', 'content', 'horizontal'=>false, 'button_text'=>null, 'button_link'=>null])
<div class="container block txt-block {{$horizontal ? 'horizontal' : ''}}">
    <div class="row mx-auto">
        @if($horizontal)
            <div class="col-6 d-flex items-center">
                <h1>{{$title}}</h1>
            </div>
            <div class="col-6">
                {{$content}}
            </div>
        @else
            <div class="d-flex flex-col">
                <h1>{{$title}}</h1>
                {{$content}}
                @if($button_text && $button_link)
                    <p><a href="{{$button_link}}" class="btn btn-primary">{{$button_text}}</a></p>
                @endif
            </div>
        @endif
    </div>
</div>
