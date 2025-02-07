<div class="pb-[100px] min-h-[calc(100vh-50px-75px)] flex items-center justify-center">
    <div class="w-full max-w-md">
        <x-profile-menu />
        <h1 class="text-2xl font-bold mb-4">Advertisement</h1>
        @if(isset($advertisementObject))
            <form method="POST" action="{{ route('advertisement.update', ['id' => $advertisementObject->id]) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @method('PUT')
                @csrf
                @else
                    <form method="POST" action="{{ route('advertisement.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        @csrf
                        @endif
                        <x-forms.input-text name="title" :required="true" value="{{ $advertisementObject->title ?? '' }}"/>
                        <x-forms.textarea name="description" :class="'min-h-[100px] max-h-[300px]'">{{ $advertisementObject->description ?? '' }}</x-forms.textarea>
                        <x-forms.input-number name="price" :required="true" :defer="true" value="{{ $advertisementObject->price ?? '' }}"/>
                        <x-forms.input-select name="type" :required="true" :defer="true" :list="$types" value="{{ $advertisementObject->type ?? '' }}"/>
                        <x-forms.input-date name="expires_at" :required="true" :defer="true" value="{{ $advertisementObject->expires_at ?? '' }}"/>
                        <x-forms.input-file name="image" :title="$advertisementObject->title.' image' ?? ''" value="{{ $advertisementObject->image ?? '' }}"/>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ isset($advertisementObject) ? 'Update advertisement' : 'Add advertisement' }}</button>
                    </form>
                    @if(isset($advertisementObject))
                        <form method="POST" action="{{ route('advertisement.delete', ['id' => $advertisementObject->id]) }}" class="mt-4">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete advertisement</button>
                        </form>
        @endif
    </div>
</div>
