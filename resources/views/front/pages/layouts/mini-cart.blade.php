<div class="sidebar-cart-overlay"></div>
<div class="sidebar-cart">
  <div class="cart-header">
    <h3>Cart</h3>
    <button class="close-cart">&times;</button>
  </div>
  @if (Cart::content()->isNotEmpty())
    <div class="cart-items custom-scrollbar">
        @foreach (Cart::content() as $item)
          <div class="cart-item">
            <img src="{{ asset('uploads/product-image/' . $item->options->productImage) }}" alt="Product Name">
            <div class="item-details">
              <h4>{{ $item->name }} - {{ $item->qty }}</h4>
              @php
                $salePrice = $item->sale_price ?? $item->options->sale_price ?? null;
                $regularPrice = $item->price ?? $item->options->price ?? 0;
                $quantity = $item->qty ?? 1;

              @endphp

              @if ($item->options->salePrice > 0)
                <p><del>${{ $item->price * $quantity }}</del> 
                    <strong>${{ $item->options->salePrice * $quantity }}</strong>
                </p>
              @else
                <p>${{ $item->price * $quantity }}</p>
            @endif
            </div>
            <button onclick="deleteItem('{{ $item->rowId }}')" class="remove-item">&times;</button>
          </div>
        @endforeach
        <!-- Repeat for other items -->
    </div>
    @else
    <div class="cart-items d-flex justify-content-center align-items-center empty-cart">
      <p>Cart is empty</p>
    </div>
  @endif
  <div class="cart-footer">
    <p>Subtotal: <span>${{ cartTotal() }}</span></p>
    <button onclick="window.location.href='{{ route('front.cart') }}'" class="view-cart">View Cart</button>
    <button onclick="window.location.href='{{ route('front.viewCheckout') }}'" class="checkout">Checkout</button>
  </div>
</div>