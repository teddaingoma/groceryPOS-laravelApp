@props(['typeSale' => $typeSale])

<tr>
    <th scope="row">{{ $typeSale->CommodityType->type_name }}</th>
    <td>
        <span class="data-name">Budgeted Sales (K):</span>
        {{ $typeSale->CommodityType->TypePrice->type_price * $typeSale->CommodityType->TypeQuantity->type_quantity }}
    </td>
    <td>
        <span class="data-name">Cost (K):</span>
        {{ $typeSale->CommodityType->TypeCostPrice->type_cost_price * $typeSale->CommodityType->TypeQuantity->type_quantity }}
    </td>
    <td>
        <span class="data-name">Budgeted Gross Profit (K):</span>
        {{
            ( $typeSale->CommodityType->TypePrice->type_price * $typeSale->CommodityType->TypeQuantity->type_quantity ) -
            ( $typeSale->CommodityType->TypeCostPrice->type_cost_price * $typeSale->CommodityType->TypeQuantity->type_quantity )
        }}
    </td>
</tr>
