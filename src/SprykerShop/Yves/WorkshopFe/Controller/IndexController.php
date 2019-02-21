<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\WorkshopFe\Controller;

use Spryker\Shared\Storage\StorageConstants;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;
use Spryker\Client\Kernel\Locator;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    protected $baseDir = __DIR__;

    public function indexAction(Request $request)
    {
        // this is f**king dangerous 😱...
        $task = $this->getTask($request);
        $viewData = $this->executeIndexAction($task);

        return $this->view(
            $viewData,
            $this->getFactory()->getWorkshopFeWidgetPlugins(),
            '@WorkshopFe/views/task-' . $task . '/task-' . $task . '.twig'
        );
    }

    protected function getTask(Request $request)
    {
        // 😎 look how nice this is...
        $task = $request->get('task');

        if (!$task) {
           return 0;
        }

        return $task;
    }

    protected function executeIndexAction($task): array
    {
        $cars = $this->getAllFreakingCarsPlease();
        $questions = $this->getSneakyQuestions($task);

        return [
            'task' => $task,
            'cars' => $cars,
            'questions' => $questions
        ];
    }

    protected function getAllFreakingCarsPlease() {
        // 😭 😱 forgive me...
        $client = Locator::getInstance()->storage()->client();

        // 🚗💨
        $cars = [
            $this->getOneFreakingCarPlease($client, 'product_concrete:en_us:1', 'product_abstract_image:en_us:1'),
            $this->getOneFreakingCarPlease($client, 'product_concrete:en_us:2', 'product_abstract_image:en_us:2'),
            $this->getOneFreakingCarPlease($client, 'product_concrete:en_us:3', 'product_abstract_image:en_us:3'),
            $this->getOneFreakingCarPlease($client, 'product_concrete:en_us:4', 'product_abstract_image:en_us:4'),
        ];

        return $cars;
    }

    protected function getOneFreakingCarPlease($client, $carId, $carImagesId) {
        $car = $client->get($carId);
        $carTopSpeed = $car['attributes']['top_speed'];

        $carImages = $client->get($carImagesId);
        $carImageUrl = $carImages['image_sets'][0]['images'][0]['external_url_large'];

        $car['topSpeed'] = $carTopSpeed;
        $car['imageUrl'] = $carImageUrl;

        return $car;
    }

    protected function getSneakyQuestions($task) {
        // 🤔
        $path = $this->getSneakyQuestionsJsonFilePath($task);
        $file = file_get_contents($path);
        $questions = json_decode($file, true);

        return $questions['questions'];
    }

    protected function getSneakyQuestionsJsonFilePath($task) {
        // 🤔
        $projectPath = realpath(
            __DIR__ .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..'
        );

        return $projectPath . '/data/workshop-fe/questions-' . $task . '.json';
    }
}
