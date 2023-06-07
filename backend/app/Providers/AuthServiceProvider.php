<?php

namespace App\Providers;

use App\Catalog\Entity\ClientCompany;
use App\Catalog\Entity\Order;
use App\Catalog\Entity\OrderLine;
use App\Catalog\Policies\ClientCompanyPolicy;
use App\Catalog\Policies\OrderLinePolicy;
use App\Catalog\Policies\OrderPolicy;
use App\Dictionary\Entity\CarriageSeries;
use App\Dictionary\Entity\CarriageType;
use App\Dictionary\Entity\Category;
use App\Dictionary\Entity\Status;
use App\Dictionary\Policies\CarriageSeriesPolicy;
use App\Dictionary\Policies\CarriageTypePolicy;
use App\Dictionary\Policies\CategoryPolicy;
use App\Dictionary\Policies\StatusPolicy;
use App\Product\Entity\File;
use App\Product\Entity\Image;
use App\Product\Entity\Product;
use App\Product\Entity\ProductAdditionalField;
use App\Product\Entity\ProductDetail;
use App\Product\Policies\FilePolicy;
use App\Product\Policies\ImagePolicy;
use App\Product\Policies\ProductAdditionalFieldPolicy;
use App\Product\Policies\ProductDetailPolicy;
use App\Product\Policies\ProductPolicy;
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
        CarriageSeries::class => CarriageSeriesPolicy::class,
        CarriageType::class => CarriageTypePolicy::class,
        Category::class => CategoryPolicy::class,
        Status::class => StatusPolicy::class,
        #PRODUCTS
        File::class => FilePolicy::class,
        Image::class => ImagePolicy::class,
        Product::class => ProductPolicy::class,
        ProductAdditionalField::class => ProductAdditionalFieldPolicy::class,
        ProductDetail::class => ProductDetailPolicy::class,
        #CATALOG
        ClientCompany::class => ClientCompanyPolicy::class,
        Order::class => OrderPolicy::class,
        OrderLine::class => OrderLinePolicy::class,
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
