<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    public function label()
    {
        return 'Панель информации';
    }

    public function cards()
    {
        return [];
    }
}
