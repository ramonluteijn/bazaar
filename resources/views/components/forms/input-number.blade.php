@props(['name', 'required' => false, 'defer' => false, 'value'])

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $name }}">
        {{ \Illuminate\Support\Str::of($name)->kebab()->replace('-', ' ')->ucfirst() }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    @if($defer)
        <input type="number" name="{{ $name }}" value="{{ $value }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" {{ $required ? 'required' : '' }} wire:model.blur="{{ $name }}">
    @else
        <input type="number" name="{{ $name }}" value="{{ $value }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" {{ $required ? 'required' : '' }} wire:model="{{ $name }}">
    @endif
    @error($name)
        <span class="text-red-500 text-xs italic">{{ $message }}</span>
    @enderror
</div>
