@props(['type' => $type, 'commodity' => $commodity])

<tr>
    <th scope="row">{{ $type -> type_name }}</th>
    <td>
        <span class="data-name">Price (K):</span>
        @if ($type->TypePrice == '')
            00.00
        @else
            {{ $type->TypePrice->type_price }}
        @endif
        /
        @if ($commodity->Unit == '')
            Unit
        @else
            {{ $commodity->Unit -> unit }}
        @endif
    </td>
    <td>
        <span class="data-name">Quantity:</span>
        {{ $type->TypeQuantity->type_quantity }}
    </td>
    <td>
        <span class="data-name">Sell:</span>
        <a href="{{ route('sell_type', ['commodity' => $commodity->id, 'type' => $type->id]) }}" class="btn btn--category btn--icon">
            <span class="icon-container icon--small">
                <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
            </span>
            <span class="btn__text">Sell</span>
        </a>
    </td>
</tr>
