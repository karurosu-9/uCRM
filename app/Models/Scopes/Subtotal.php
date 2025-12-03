<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Subtotal implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $sql = 'SELECT purchases.id AS id,
                       item_purchase.id AS pivot_id,
                       items.price * item_purchase.quantity AS subtotal,
                       customers.name AS customer_name,
                       items.name AS item_name,
                       items.price AS item_price,
                       item_purchase.quantity,
                       purchases.status,
                       purchases.created_at,
                       purchases.updated_at
                From   purchases
                LEFT JOIN item_purchase ON purchases.id = item_purchase.purchase_id
                LEFT JOIN items ON item_purchase.item_id = items.id
                LEFT JOIN customers ON purchases.customer_id = customers.id';

        $builder->fromSub($sql, 'order_subtotals');
    }
}
