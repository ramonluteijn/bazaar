@props(['name', 'required' => false, 'list', 'value'])

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $name }}">
        {{ \Illuminate\Support\Str::of($name)->kebab()->replace('-', ' ')->ucfirst() }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <select name="{{ $name }}" id="{{ $name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" {{ $required ? 'required' : '' }} wire:model="{{ $name }}">
        <option value="">Select a {{ $name }}</option>
        @foreach($list as $code => $typeName)
            <option value="{{ $typeName }}" {{ $typeName == $value ? 'selected' : '' }}>
                {{ $typeName }}
            </option>
        @endforeach
    </select>
    @error($name)
        <span class="text-red-500 text-xs italic">{{ $message }}</span>
    @enderror
</div>
