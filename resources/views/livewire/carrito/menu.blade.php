<div class="relative flex items-center" >
    <a href="{{ route('carrito') }}">
        @if( $num_prod > 0 )
            <span class="carrito absolute" style="background: #fff;width: 20px;height: 20px;font-size: 11px;text-align: center;border-radius: 10px;padding: 5px;top: calc( 50% - 20px );right: calc( 50% - 20px );">{{ $num_prod }}</span>
        @endif
        <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g data-name="Layer 2"><g data-name="shopping-cart"><rect width="24" height="24" opacity="0"/><path d="M21.08 7a2 2 0 0 0-1.7-1H6.58L6 3.74A1 1 0 0 0 5 3H3a1 1 0 0 0 0 2h1.24L7 15.26A1 1 0 0 0 8 16h9a1 1 0 0 0 .89-.55l3.28-6.56A2 2 0 0 0 21.08 7zm-4.7 7H8.76L7.13 8h12.25z"/><circle cx="7.5" cy="19.5" r="1.5"/><circle cx="17.5" cy="19.5" r="1.5"/></g></g></svg>
    </a>
</div>