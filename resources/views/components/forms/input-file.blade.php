@props(["name","required" => false,"value", "title" => "","class" => "", "multiple" => false])

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $name }}">
        {{ \Illuminate\Support\Str::of($name)->kebab()->replace("_", " ")->ucfirst() }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    @if ($value)
        <div class="mb-2">
            <a href="{{ asset('storage/'.$value) }}" target="_blank" class="text-blue-500">{{ $title }}</a>
        </div>
    @endif

    <input type="file" name="{{ $name }}{{ $multiple ? '[]' : '' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $class }}"{{ $required ? "required" : "" }} {{ $multiple ? "multiple" : "" }}/>
    @if ($value)
        <input type="hidden" name="{{ $name }}_existing" value="{{ $value }}">
    @endif
    @error($name)
        <span class="text-red-500 text-xs italic">{{ $message }}</span>
    @enderror
</div>
