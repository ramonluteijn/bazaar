@props(["name", "required" => false, "list" => [], "enum" => null, "value", "class" => ""])

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $name }}">
        {{ \Illuminate\Support\Str::of($name)->kebab()->replace("-", " ")->ucfirst() }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <select name="{{ $name }}" id="{{ $name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $class }}"{{ $required ? "required" : "" }}>
        <option value="">Select a {{ $name }}</option>
        @if ($enum)
            @foreach ($enum::cases() as $item)
                <option value="{{ $item->value }}"{{ $item->name == $value ? "selected" : "" }}>
                    {{ $item->name }}
                </option>
            @endforeach
        @else
            @foreach ($list as $item)
                <option value="{{ $item }}" {{ $item == $value ? "selected" : "" }}>
                    {{ $item }}
                </option>
            @endforeach
        @endif
    </select>
    @error($name)
    <span class="text-red-500 text-xs italic">{{ $message }}</span>
    @enderror
</div>
