@props(["name","required" => false,"class" => "", "label" => ""])
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $name }}">
        {{ \Illuminate\Support\Str::of($label)->kebab()->replace("_", " ")->ucfirst() }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <textarea name="{{ $name }}" id="{{ $name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $class }}"{{ $required ? "required" : "" }}>{{ $slot }}</textarea>
    @error($name)
    <span class="text-red-500 text-xs italic">{{ $message }}</span>
    @enderror
</div>
