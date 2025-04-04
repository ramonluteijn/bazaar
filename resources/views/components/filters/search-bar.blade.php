@props(['label' => 'Zoeken', 'placeholder' => 'Zoeken...', 'params' => []])

<form method="GET" action="{{ route(Route::currentRouteName()) }}">
    @foreach($params as $name)
        @if($name === 'search')
            @continue
        @endif
        <input type="hidden" name="{{ $name }}" value="{{ request($name) }}">
    @endforeach
    <x-forms.input-field label="{{$label}}" name="search" placeholder="{{$placeholder}}" value="{{ request('search') }}"/>
</form>
