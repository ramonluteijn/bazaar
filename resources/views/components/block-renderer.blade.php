@props(['pages'])

<h1>{{ $pages->title }}</h1>
@foreach($pages->blocks as $block)
    @if($block->type->name === 'TEXT_IMAGE')
        <x-blocks.txt-image-block :title="$block->title" :content="$block->content" :image="$block->textBlockImage"/>
    @elseif($block->type->name === 'TEXT')
        <x-blocks.text-block :title="$block->title" :content="$block->content" :button_text="$block->link_text" :button_link="$block->button_link"/>
    @elseif($block->type->name === 'TEXT_HORIZONTAL')
        <x-blocks.text-block :title="$block->title" :content="$block->content" :horizontal="true"/>
    @elseif($block->type->name === 'QUOTE')
        <x-blocks.quote-block :title="$block->title"/>
    @elseif($block->type->name === 'CTA')
        <x-blocks.cta :title="$block->title" :content="$block->content" :button_text="$block->link_text" :button_link="$block->button_link" :image="$block->textBlockImage" :background="$block->background_color"/>
    @elseif($block->type->name === 'NEW_ITEMS')
        @livewire('new-items-component', ['title' => $block->title ?? null, 'amount' => $block->amount, 'link' => $block->button_link ?? null, 'linkText' => $block->link_text ?? null])
    @elseif($block->type->name === 'GALLERY')
        <x-blocks.gallery :title="$block->title" :images="$block->galleryImages"/>
    @elseif($block->type->name === 'HERO')
        <x-blocks.hero :title="$block->title" :button_text="$block->link_text" :button_link="$block->button_link" :image="$block->textBlockImage"  :background="$block->background_color"/>
    @elseif($block->type->name === 'TEXT_PRODUCT')
        <x-blocks.text-product :title="$block->title" :content="$block->content" :product="$block->product"/>
    @endif
@endforeach

@if(collect($pages->blocks)->contains('type.name', 'TESTIMONIAL'))
    <div class="swiper-container container block testimonial" id="testimonialSwiper">
        <div class="swiper-wrapper">
            @foreach($pages->blocks->where('type.name', 'TESTIMONIAL') as $block)
                <div class="swiper-slide">
                    <x-blocks.testimonial :title="$block->title" :content="$block->content" :author="$block->author" :button_text="$block->link_text" :site_link="$block->site_link"/>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
@endif
