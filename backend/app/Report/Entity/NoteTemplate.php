<?php

namespace App\Report\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Report\Entity\NoteTemplate
 *
 * @property int $id
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|NoteTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoteTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoteTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|NoteTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoteTemplate whereType($value)
 * @mixin \Eloquent
 */
class NoteTemplate extends Model
{
    public const EXPLANATORY = "explanatory";

    public $timestamps = false;

    protected $fillable = [
        'type',
    ];

    public ?string $file;

    public const DIRS = [
        self::EXPLANATORY => '/reports/explanatory',
    ];

    public const VALUES = [
        self::EXPLANATORY => 'Шаблон пояснительной записки',
    ];
}
