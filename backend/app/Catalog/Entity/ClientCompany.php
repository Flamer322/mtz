<?php

namespace App\Catalog\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Catalog\Entity\ClientCompany
 *
 * @property int $id
 * @property int $client_id
 * @property string $legal_name
 * @property string|null $legal_address
 * @property string|null $post_address
 * @property string|null $inn
 * @property string|null $okpo
 * @property string|null $kpp
 * @property string|null $ogrn
 * @property string|null $bik
 * @property string|null $corr_account
 * @property string|null $bank_account
 * @property string|null $main_organization
 * @property string|null $short_name
 * @property string|null $bank_name
 * @property string|null $director_post
 * @property string|null $director_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Catalog\Entity\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereBankAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereBik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereCorrAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereDirectorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereDirectorPost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereInn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereKpp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereLegalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereLegalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereMainOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereOgrn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereOkpo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany wherePostAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientCompany withoutTrashed()
 * @mixin \Eloquent
 */
class ClientCompany extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'legal_address',
        'post_address',
        'inn',
        'okpo',
        'kpp',
        'ogrn',
        'bik',
        'corr_account',
        'bank_account',
        'main_organization',
        'short_name',
        'bank_name',
        'director_post',
        'director_name',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
