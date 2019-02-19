<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\WorkshopFe\Controller;

use Spryker\Shared\Storage\StorageConstants;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;

/**
 * @method \SprykerShop\Yves\WorkshopFe\WorkshopFeFactory getFactory()
 */
class IndexController extends AbstractController
{
    /**
     * @return \Spryker\Yves\Kernel\View\View
     */
    public function indexAction()
    {
        $viewData = $this->executeIndexAction();

        return $this->view(
            $viewData,
            $this->getFactory()->getWorkshopFeWidgetPlugins(),
            '@WorkshopFe/views/workshop/workshop.twig'
        );
    }

    /**
     * @return array
     */
    protected function executeIndexAction(): array
    {
        return [
            // 'featuredProductLimit' => static::FEATURED_PRODUCT_LIMIT,
        ];
    }
}
