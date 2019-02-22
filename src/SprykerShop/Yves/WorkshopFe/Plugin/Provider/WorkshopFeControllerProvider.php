<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\WorkshopFe\Plugin\Provider;

use Silex\Application;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

class WorkshopFeControllerProvider extends AbstractYvesControllerProvider
{
    public const ROUTE_WORKSHOP_FE = 'workshop-fe';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $this->addWorkshopFeRoute();
    }

    /**
     * @return $this
     */
    protected function addWorkshopFeRoute()
    {
        $this->createController('/workshop-fe', self::ROUTE_WORKSHOP_FE, 'WorkshopFe', 'Index');
        return $this;
    }
}
