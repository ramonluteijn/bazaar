@props(["name","checked" => false,"disabled" => false])

<div class="form-group flex items-center space-x-2">
    <input type="checkbox" name="{{$name}}" id="{{$name}}" @if($checked) checked @endif @if($disabled) disabled @endif class="form-checkbox h-5 w-5 text-blue-600">
    <label for="{{$name}}" class="ml-2 text-gray-700">{{ \Illuminate\Support\Str::of($name)->kebab()->replace("_", " ")->ucfirst() }}</label>
</div>
