<div class="relative">
    <a href="{{ route('basket.show') }}">
        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.3 5H21L19 12H7.4M20 16H8L6 3H3M9 20C9 20.6 8.6 21 8 21C7.4 21 7 20.6 7 20C7 19.4 7.4 19 8 19C8.6 19 9 19.4 9 20ZM20 20C20 20.6 19.6 21 19 21C18.4 21 18 20.6 18 20C18 19.4 18.4 19 19 19C19.6 19 20 19.4 20 20Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        @if($itemCount > 0)
            <span class="absolute top-[-5px] right-[-5px] inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $itemCount }}</span>
        @endif
    </a>
</div>
