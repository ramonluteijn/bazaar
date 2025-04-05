@props(['label' => '', 'placeholder' => '', 'params' => []])

<form method="GET" action="{{ url()->current() }}" >
    @foreach($params as $name)
        @if($name === 'search')
            @continue
        @endif
        <input type="hidden" name="{{ $name }}" value="{{ request($name) }}">
    @endforeach
    <x-forms.input-field id="search" label="{{$label}}" name="search" placeholder="{{$placeholder}}" value="{{ request('search') }}"/>
</form>
