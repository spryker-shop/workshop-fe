<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\WorkshopFe\Controller;

use Spryker\Shared\Storage\StorageConstants;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;
use Spryker\Client\Kernel\Locator;

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
        // 😭 😱 forgive me...
        $client = Locator::getInstance()->storage()->client();

        // 🚗💨
        $cars = [
            $this->getTheFreakingCarPlease($client, 'product_concrete:en_us:1', 'product_abstract_image:en_us:1'),
            $this->getTheFreakingCarPlease($client, 'product_concrete:en_us:2', 'product_abstract_image:en_us:2'),
            $this->getTheFreakingCarPlease($client, 'product_concrete:en_us:3', 'product_abstract_image:en_us:3'),
            $this->getTheFreakingCarPlease($client, 'product_concrete:en_us:4', 'product_abstract_image:en_us:4'),
        ];

        return [
            'cars' => $cars
        ];
    }

    protected function getTheFreakingCarPlease($client, $carId, $carImagesId) {
        $car = $client->get($carId);
        $carTopSpeed = $car['attributes']['top_speed'];

        // var_dump($car); die;

        $carImages = $client->get($carImagesId);
        $carImageUrl = $carImages['image_sets'][0]['images'][0]['external_url_large'];

        $car['topSpeed'] = $carTopSpeed;
        $car['imageUrl'] = $carImageUrl;

        return $car;
    }
}
