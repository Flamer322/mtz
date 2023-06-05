<?php

namespace App\Providers;

use App\Catalog\Entity\ClientCompany;
use App\Catalog\Entity\Order;
use App\Catalog\Entity\OrderLine;
use App\Catalog\Policies\CatalogPolicy;
use App\Dictionary\Entity\CarriageSeries;
use App\Dictionary\Entity\CarriageType;
use App\Dictionary\Entity\Category;
use App\Dictionary\Entity\Status;
use App\Dictionary\Policies\DictionaryPolicy;
use App\Product\Entity\File;
use App\Product\Entity\Image;
use App\Product\Entity\Product;
use App\Product\Entity\ProductAdditionalField;
use App\Product\Entity\ProductDetail;
use App\Product\Policies\ProductPolicy;
use App\Product\Policies\ProductProductPolicy;
use App\User\Entity\User;
use App\User\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        #USER
        User::class => UserPolicy::class,
        #DICTS
        CarriageSeries::class => DictionaryPolicy::class,
        CarriageType::class => DictionaryPolicy::class,
        Category::class => DictionaryPolicy::class,
        Status::class => DictionaryPolicy::class,
        #PRODUCTS
        File::class => ProductPolicy::class,
        Image::class => ProductPolicy::class,
        Product::class => ProductProductPolicy::class,
        ProductAdditionalField::class => ProductPolicy::class,
        ProductDetail::class => ProductPolicy::class,
        #CATALOG
        ClientCompany::class => CatalogPolicy::class,
        Order::class => CatalogPolicy::class,
        OrderLine::class => CatalogPolicy::class,
        #CLAIMS
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
