<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const NEW_STATUS = 'new';
    const IN_WORK_STATUS = 'in_work';
    const COMPLETED_STATUS = 'completed';

    const CANCEL_STATUS = 'cancel';

    const REFUSAL_STATUS = 'refulas';

    const DELETE_STATUS = 'delete';

    const STATUSES = [
        self::NEW_STATUS,
        self::IN_WORK_STATUS,
        self::COMPLETED_STATUS,
        self::CANCEL_STATUS,
        self::REFUSAL_STATUS,
        self::DELETE_STATUS,
    ];


    const SUCCESS_PAYMENT = 'success';
    const FAILED_PAYMENT = 'failed';

    const PAYMENT_STATUSES = [
        self::SUCCESS_PAYMENT,
        self::FAILED_PAYMENT
    ];


    protected $with = [
        'products', 'account'
    ];

    public function account() {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
            ->withPivot('price', 'values', 'count', 'price_for_one');
    }

}
