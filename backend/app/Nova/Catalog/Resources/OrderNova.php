<?php

namespace App\Nova\Catalog\Resources;

use App\Catalog\Entity\Order;
use App\Nova\Resource;
use App\Nova\User\Resources\UserNova;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderNova extends Resource
{
    use HasTabs;

    public static $model = Order::class;

    public static $title = 'id';

    public static $group = 'Заявки';

    public static function label()
    {
        return 'Заявки';
    }

    public static function singularLabel()
    {
        return 'Заявка';
    }

    public function fields(NovaRequest $request)
    {
        return [
            Tabs\Tabs::make('Изделие', [
                Tabs\Tab::make('Основная информация', [
                    Fields\ID::make()
                        ->sortable(),

                    Fields\BelongsTo::make('Клиент', 'user', UserNova::class),

                    Fields\BelongsTo::make('Компания покупатель', 'buyerCompany', ClientCompanyNova::class)
                        ->hideFromIndex(),

                    Fields\BelongsTo::make('Компания плательщик', 'payerCompany', ClientCompanyNova::class)
                        ->hideFromIndex(),

                    Fields\BelongsTo::make('Компания получатель', 'recipientCompany', ClientCompanyNova::class)
                        ->hideFromIndex(),

                    Fields\Text::make('Контактное ФИО', 'contact_name'),

                    Fields\Text::make('Контактный номер', 'contact_phone'),

                    Fields\Text::make('Контактная почта', 'contact_email'),

                    Fields\Text::make('Вид документов по заказу', 'document_type')
                        ->hideFromIndex(),

                    Fields\Text::make('Комментарий', 'comment')
                        ->hideFromIndex(),

                    Fields\Text::make('Конечный потребитель продукции', 'end_user_of_product')
                        ->hideFromIndex(),

                    Fields\Text::make('Пожелание по срокам поставки', 'delivery_date')
                        ->hideFromIndex(),

                    Fields\Text::make('Статус', static fn (Order $order) => $order->status()),

                    Fields\DateTime::make('Дата создания', 'created_at'),
                ]),

                Fields\HasMany::make('Позиции заявки', 'lines', OrderLineNova::class),

                Files::make('Файлы заявки', 'files'),
            ]),
        ];
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }
}
