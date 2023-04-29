<?php

namespace App\Nova\User\Resources;

use App\Nova\Resource;
use App\User\Entity\User;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserNova extends Resource
{
    public static $model = User::class;

    public static $title = 'email';

    public static $group = 'Пользователи';

    public static function label()
    {
        return 'Пользователи';
    }

    public static function singularLabel()
    {
        return 'Пользователь';
    }

    public static $search = [
        'name', 'email',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\Text::make('Name')
                ->rules('required', 'max:255')
                ->sortable(),

            Fields\Text::make('Email')
                ->rules('required', 'email', 'max:255')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')
                ->sortable(),

            Fields\Select::make('Роль', 'role')
                ->options(User::USER_ROLES)
                ->displayUsing(static fn ($role) => User::USER_ROLES[$role])
                ->rules('required'),

            Fields\Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),
        ];
    }
}
