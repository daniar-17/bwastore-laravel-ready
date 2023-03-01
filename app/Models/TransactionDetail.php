<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';
    protected $fillable = [
        'transactions_id','transactions_id','price','shipping_status','resi','code','products_id'
    ];
    protected $hidden = [];

    public function product()
    {
        return $this->hasOne(Product::class, 'id','products_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'id','transactions_id');
    }
}
