@props(['name', 'required' => false, 'value'])

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $name }}">
        {{ \Illuminate\Support\Str::of($name)->kebab()->replace('-', ' ')->ucfirst() }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <input type="date" name="{{$name}}" value="{{ $value }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" {{ $required ? 'required' : '' }} wire:model="{{ $name }}"/>
    @error($name)
        <span class="text-red-500 text-xs italic">{{ $message }}</span>
    @enderror
</div>
