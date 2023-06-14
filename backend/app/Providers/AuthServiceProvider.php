<?php

namespace App\Providers;

use App\Catalog\Entity\ClientCompany;
use App\Catalog\Entity\Order;
use App\Catalog\Entity\OrderLine;
use App\Catalog\Policies\ClientCompanyPolicy;
use App\Catalog\Policies\OrderLinePolicy;
use App\Catalog\Policies\OrderPolicy;
use App\Claim\Entity\Claim;
use App\Claim\Entity\ClaimCompany;
use App\Claim\Entity\DefectType;
use App\Claim\Entity\OperatingTime;
use App\Claim\Entity\ProductNode;
use App\Claim\Policies\ClaimCompanyPolicy;
use App\Claim\Policies\ClaimPolicy;
use App\Claim\Policies\DefectTypePolicy;
use App\Claim\Policies\OperatingTimePolicy;
use App\Claim\Policies\ProductNodePolicy;
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
use App\Report\Entity\AlgorithmParameter;
use App\Report\Entity\ExplanatoryNote;
use App\Report\Entity\Reliability;
use App\Report\Entity\SummaryReport;
use App\Report\Policies\AlgorithmParameterPolicy;
use App\Report\Policies\ExplanatoryNotePolicy;
use App\Report\Policies\ReliabilityPolicy;
use App\Report\Policies\SummaryReportPolicy;
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
        Claim::class => ClaimPolicy::class,
        ClaimCompany::class => ClaimCompanyPolicy::class,
        DefectType::class => DefectTypePolicy::class,
        OperatingTime::class => OperatingTimePolicy::class,
        ProductNode::class => ProductNodePolicy::class,
        #REPORTS
        AlgorithmParameter::class => AlgorithmParameterPolicy::class,
        ExplanatoryNote::class => ExplanatoryNotePolicy::class,
        Reliability::class => ReliabilityPolicy::class,
        SummaryReport::class => SummaryReportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
