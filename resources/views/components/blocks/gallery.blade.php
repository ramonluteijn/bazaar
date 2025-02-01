@props(['title'=>null, 'images'=>[]])
<div class="gallery">
    <h2>{{ $title }}</h2>
    <div class="gallery-images d-flex">
        @foreach($images as $image)
            <img src="{{ asset($image) }}" alt="Gallery Image">
        @endforeach
    </div>
</div>
