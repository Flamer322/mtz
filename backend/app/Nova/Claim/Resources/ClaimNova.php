<?php

namespace App\Nova\Claim\Resources;

use App\Claim\Entity\Claim;
use App\Nova\Dictionary\Resources\CarriageSeriesNova;
use App\Nova\Dictionary\Resources\CarriageTypeNova;
use App\Nova\Product\Resources\ProductNova;
use App\Nova\Resource;
use App\Nova\User\Resources\UserNova;
use App\User\Entity\User;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClaimNova extends Resource
{
    public static $model = Claim::class;

    public static $title = 'name';

    public function title()
    {
        return '#' . $this->number . ' | ' . $this->theme;
    }

    public static $group = 'Несоответствия';

    public static function label()
    {
        return 'Несоответствия';
    }

    public static function singularLabel()
    {
        return 'Несоответствие';
    }

    public static $search = [
        'number', 'theme',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\Text::make('№ письма', 'number')
                ->rules('required', 'max:255')
                ->sortable(),

            Fields\Text::make('Тема письма', 'theme')
                ->rules('required', 'max:255')
                ->sortable(),

            Fields\BelongsTo::make('Компания заявитель', 'company', ClaimCompanyNova::class)
                ->rules('required'),

            Fields\Text::make('Место выявления', 'address')
                ->rules('max:255'),

            Fields\Date::make('Дата сообщения об отказе', 'discover_date')
                ->hideFromIndex(),

            Fields\Text::make('№ в КАСАНТ', 'kasant_number')
                ->rules('max:255')
                ->hideFromIndex()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\BelongsTo::make('Тип состава', 'carriageType', CarriageTypeNova::class)
                ->nullable()
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\BelongsTo::make('Серия состава', 'series', CarriageSeriesNova::class)
                ->nullable()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Text::make('№ подвижного состава', 'carriage_number')
                ->rules('max:255')
                ->hideFromIndex()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\BelongsTo::make('Продукция', 'product', ProductNova::class)
                ->nullable()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Text::make('Заводской № изделия', 'manufacture_number')
                ->rules('max:255')
                ->hideFromIndex()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Date::make('Дата изготовления изделия', 'manufacture_product_date')
                ->hideFromIndex()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\BelongsTo::make('Узел изделия', 'node', ProductNodeNova::class)
                ->nullable()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Text::make('Заводской № узла, детали', 'assembly_serial_number')
                ->rules('max:255')
                ->hideFromIndex()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Date::make('Дата изготовления узла', 'manufacture_date')
                ->hideFromIndex()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Text::make('Наработка до отказа (тыс.км)', 'time_to_failure')
                ->rules('max:255')
                ->hideFromIndex()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Textarea::make('Краткое описание по уведомлению', 'claimed_defect')
                ->alwaysShow()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\BelongsTo::make('Тип дефекта', 'defectType', DefectTypeNova::class)
                ->nullable()
                ->hideFromIndex()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Textarea::make('Установленный дефект', 'identified_defect')
                ->alwaysShow()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Textarea::make('Примечание', 'comment')
                ->alwaysShow()
                ->canSee(static fn () => in_array($request->user()->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER])),

            Fields\Hidden::make('Создатель', 'created_by')
                ->default(function ($request) {
                    return $request->user()->id;
                })
                ->hideFromIndex()
                ->hideFromDetail(),

            Fields\BelongsTo::make('Создатель', 'createdBy', UserNova::class)
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Fields\DateTime::make('Дата создания', 'created_at')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Files::make('Файлы', Claim::MEDIA_COLLECTION),
        ];
    }
}
