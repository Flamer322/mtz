<?php

namespace App\Nova\Catalog\Resources;

use App\Catalog\Entity\ClientCompany;
use App\Nova\Resource;
use App\Nova\User\Resources\UserNova;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClientCompanyNova extends Resource
{
    public static $model = ClientCompany::class;

    public function title()
    {
        return $this->legal_name . ' | ' . $this->inn;
    }

    public static $group = 'Заявки';

    public static function label()
    {
        return 'Компании пользователей';
    }

    public static function singularLabel()
    {
        return 'Компания пользователя';
    }

    public static $search = [
        'legal_name', 'short_name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\BelongsTo::make('Клиент', 'user', UserNova::class),

            Fields\Text::make('Краткое название', 'short_name'),

            Fields\Text::make('Полное название', 'legal_name')
                ->hideFromIndex(),

            Fields\Text::make('Юридический адрес', 'legal_address')
                ->hideFromIndex(),

            Fields\Text::make('Почтовый адрес', 'post_address')
                ->hideFromIndex(),

            Fields\Text::make('ИНН', 'inn'),

            Fields\Text::make('КПП', 'kpp')
                ->hideFromIndex(),

            Fields\Text::make('ОКПО', 'okpo')
                ->hideFromIndex(),

            Fields\Text::make('ОГРН', 'ogrn')
                ->hideFromIndex(),

            Fields\Text::make('БИК', 'bik')
                ->hideFromIndex(),

            Fields\Text::make('Корреспондентский счёт', 'corr_account')
                ->hideFromIndex(),

            Fields\Text::make('Рассчётный счет', 'bank_account')
                ->hideFromIndex(),

            Fields\Text::make('Название банка', 'bank_name')
                ->hideFromIndex(),

            Fields\Text::make('Головная организация', 'main_organization')
                ->hideFromIndex(),

            Fields\Text::make('Должность руководителя', 'director_post')
                ->hideFromIndex(),

            Fields\Text::make('ФИО руководителя', 'director_name')
                ->hideFromIndex(),

            Fields\DateTime::make('Дата создания', 'created_at'),
        ];
    }
}
