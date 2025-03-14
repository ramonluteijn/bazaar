@props(['pages'])

@foreach($pages->blocks as $block)
    @if($block->type === 'hero' && $block->active)
        <x-blocks.hero :title="$block->title" :button_text="$block->button_text" :button_link="$block->button_link" :image="$block->image_url"/>
    @elseif($block->type === 'text' && $block->active)
        <x-blocks.text-block :title="$block->title" :content="$block->text" :button_text="$block->button_text" :button_link="$block->button_link"/>
    @elseif($block->type === 'cta' && $block->active)
        <x-blocks.cta :title="$block->title" :content="$block->text" :button_text="$block->button_text" :button_link="$block->button_link" :image="$block->image_url"/>
    @elseif($block->type === 'quote' && $block->active)
        <x-blocks.quote-block :title="$block->title"/>
    @endif
@endforeach
