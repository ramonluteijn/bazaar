@props(['title', 'content', 'image'=>null])
<div class="container block txt-image">
    <div class="row mx-auto items-stretch justify-end d-flex w-100">
        <div class="col-6 block text-block">
            <h1>{{$title}}</h1>
            {{$content}}
        </div>
        <div class="col-6 block image-block">
            <div class="justify-start h-100 d-flex w-100 inner wrapper">
                @if($image != null)
                    <img src="{{asset($image)}}" class="object-cover w-100">
                @endif
            </div>
        </div>
    </div>
</div>
