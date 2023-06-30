@props(['budgetedSales' => $budgetedSales])

<tr>
    <th scope="row">{{ $budgetedSales->CommodityBudgetedSale->name }}</th>
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
