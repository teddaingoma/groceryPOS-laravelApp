@props(['budgetedSales' => $budgetedSales])

<tr>
    <th scope="row">
        <a class="data-link" href="{{ route('home.show', $budgetedSales->commodity_id) }}">
            {{ $budgetedSales->CommodityBudgetedSale->name }}
        </a>
    </th>
    <td>
        <span class="data-name">Budgeted Sales (K):</span>
        {{ $budgetedSales->quantity * $budgetedSales->CommodityBudgetedSale->Price->price }}
    </td>
    <td>
        <span class="data-name">Cost (K):</span>
        {{ $budgetedSales->quantity * $budgetedSales->CommodityBudgetedSale->CostPrice->cost_price }}
    </td>
    <td>
        <span class="data-name">Budgeted Gross Profit (K):</span>
        {{
            ( $budgetedSales->quantity * $budgetedSales->CommodityBudgetedSale->Price->price ) -
            ( $budgetedSales->quantity * $budgetedSales->CommodityBudgetedSale->CostPrice->cost_price )
        }}
    </td>
</tr>
