<div class="table-responsive">
    <table class="table">
        <tbody>
            @foreach ($cart as $cartItem)
                @php $product = $cartItem['attributes']['product'] @endphp
                <tr class="cart-item">
                    <td>
                        img
                    </td>

                    <td>
                        <h5>
                            <a href="{{ route('products.show', $product['slug']) }}">{{ $cartItem['name'] }}</a>
                        </h5>
                    </td>

                    <td>
                        <div class="pull-left" style="margin: 10px;">
                            <label><strong class="badge badge-secondary">Price:</strong></label>
                            <ul class="list-unstyled">
                                <li><strong class="text-info">Wholesale:</strong> <span>{{ theMoney($cartItem['price']) }}</span></li>
                                <li><strong class="text-primary">Retail:</strong> <span>{{ theMoney($product['retail_price']) }}</span></li>
                            </ul>
                        </div>
                        <div class="pull-left" style="margin: 10px;">
                            <label for=""><strong class="badge badge-secondary">Quantity:</strong></label>
                            <br>
                            <div class="quantity pull-left clearfix">
                                <div class="input-group-quantity pull-left clearfix">
                                    <input type="text" name="qty" value="{{ $cartItem['quantity'] }}" class="input-number input-quantity pull-left {{ "qty-{$loop->index}"  }}" min="1" max="{{ isset($product['manage_stock']) && !is_null($product['manage_stock']) && isset($product['qty']) ? $product['qty'] : '' }}">

                                    <span class="pull-left btn-wrapper">
                                        <button type="button" class="btn btn-number btn-plus" datatype="plus" wire:click="increment({{ $cartItem['id'] }})"> + </button>
                                        <button type="button" class="btn btn-number btn-minus" datatype="minus" wire:click="decrement({{ $cartItem['id'] }})" {{ $cartItem['quantity'] === 1 ? 'disabled' : '' }}> &#8211; </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td></td>
                    <td></td>

                    <td width="1">
                        <form method="POST" action="{{ route('cart.remove', $cartItem['id']) }}" onsubmit="return confirm('Are Your Sure To Remove It?');">
                            @csrf
                            {{ method_field('DELETE') }}

                            <button type="submit" wire:click.prevent="remove({{ $cartItem['id'] }})" wire:loading.remove class="btn-close" data-toggle="tooltip" data-placement="top" title="Remove">
                                &times;
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>