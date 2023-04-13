<?php

namespace App\Catalog\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Catalog\Entity\OrderFile
 *
 * @property int $id
 * @property int $order_id
 * @property string $file
 * @property string|null $name
 * @property-read \App\Catalog\Entity\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereOrderId($value)
 * @mixin \Eloquent
 */
class OrderFile extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'file',
        'name',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
