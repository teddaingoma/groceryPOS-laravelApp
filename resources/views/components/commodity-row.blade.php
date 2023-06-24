@props(['commodity' => $commodity])

<tr>
    <th scope="row">{{ $commodity -> name }}</th>
    <td>
        <span class="data-name">Price (K):</span>
        @if ($commodity->Price == '')
            00.00
        @else
            {{ $commodity->Price->price }}
        @endif
        /
        @if ($commodity->Unit == '')
            unit
        @else
            {{ $commodity->Unit -> unit }}
        @endif
    </td>
    <td>
        <span class="data-name">Quantity:</span>
        {{ $commodity->Quantity -> quantity }}
    </td>
    <td>
        <span class="data-name">Sell:</span>
        <a href="{{ route('sell_commodity', ['commodity' => $commodity->id]) }}" class="btn btn--category btn--icon">
            <span class="icon-container icon--small">
                <img class="icon" src="{{ URL("images/sell-dark.ico") }}" alt="">
            </span>
            <span class="btn__text">Sell</span>
        </a>
    </td>
</tr>
