<?php

namespace App\Nova\Catalog;

use App\Catalog\Entity\Client;
use App\Nova\Resource;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClientNova extends Resource
{
    public static $model = Client::class;

    public static $title = 'email';

    public static $group = 'Заявки';

    public static function label()
    {
        return 'Клиенты';
    }

    public static function singularLabel()
    {
        return 'Клиент';
    }

    public static $search = [
        'name', 'email',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\Text::make('Имя', 'name')
                ->rules('required', 'max:255')
                ->sortable(),

            Fields\Text::make('Email', 'email')
                ->rules('required', 'email', 'max:255')
                ->creationRules('unique:clients,email')
                ->updateRules('unique:clients,email,{{resourceId}}')
                ->sortable(),

            Fields\Password::make('Пароль', 'password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),

            Fields\Text::make('Номер телефона', 'phone')
                ->rules('required', 'phone:RU', 'max:255'),
        ];
    }

//    public static function authorizedToCreate(Request $request) //TODO uncomment
//    {
//        return false;
//    }
//
//    public function authorizedToUpdate(Request $request)
//    {
//        return false;
//    }
}
