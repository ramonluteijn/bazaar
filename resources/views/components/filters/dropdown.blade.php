@props([
  "name",
  "list" => [],
  "enum" => null,
  "label" => "",
  "default" => "",
  "params" => []
])

<form method="GET" action="{{ url()->current() }}">
    @foreach($params as $paramMame)
        @if($paramMame === $name)
            @continue
        @endif
            <input type="hidden" name="{{ $paramMame }}" value="{{ request($paramMame) }}">
    @endforeach
    <x-forms.input-select :onchange="'this.form.submit()'" label="{{$label}}" default="{{$default}}" name="{{$name}}" :list="$list" enum="{{$enum}}" value="{{ request($name) }}"/>
</form>
