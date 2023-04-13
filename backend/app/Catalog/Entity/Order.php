<?php

namespace App\Catalog\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Catalog\Entity\Order
 *
 * @property int $id
 * @property int $client_id
 * @property int $buyer_company_id
 * @property int $payer_company_id
 * @property int $recipient_company_id
 * @property string|null $contact_name
 * @property string|null $contact_phone
 * @property string|null $contact_email
 * @property string|null $document_type
 * @property string|null $comment
 * @property string|null $end_user_of_product
 * @property string|null $delivery_date
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Catalog\Entity\ClientCompany $buyerCompany
 * @property-read \App\Catalog\Entity\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Catalog\Entity\OrderFile> $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Catalog\Entity\OrderLine> $lines
 * @property-read int|null $lines_count
 * @property-read \App\Catalog\Entity\ClientCompany $payerCompany
 * @property-read \App\Catalog\Entity\ClientCompany $recipientCompany
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBuyerCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEndUserOfProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePayerCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRecipientCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order withoutTrashed()
 * @mixin \Eloquent
 */
class Order extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'contact_name',
        'contact_phone',
        'contact_email',
        'document_type',
        'comment',
        'end_user_of_product',
        'delivery_date',
        'status',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function buyerCompany(): BelongsTo
    {
        return $this->belongsTo(ClientCompany::class, 'buyer_company_id');
    }

    public function payerCompany(): BelongsTo
    {
        return $this->belongsTo(ClientCompany::class, 'payer_company_id');
    }

    public function recipientCompany(): BelongsTo
    {
        return $this->belongsTo(ClientCompany::class, 'recipient_company_id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(OrderFile::class, 'order_id');
    }

    public function lines(): HasMany
    {
        return $this->hasMany(OrderLine::class, 'order_id');
    }
}
