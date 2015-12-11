<?php

namespace Loo\Core;

use Exception;
use Loo\Data\Settings;
use Loo\Exception\InvalidTypeException;
use Loo\Exception\NotExistsException;
use Loo\Http\Request;
use Loo\Data\DataFactory;
use Loo\Http\Response;

/**
 * The main class of this framework. Let it run!
 *
 */
class Loo
{
    /** @var DataFactory */
    private $masterFactory;

    /**
     * @param MasterFactory $masterFactory
     */
    public function __construct(MasterFactory $masterFactory)
    {
        $this->masterFactory = $masterFactory;
    }

    /**
     * Process the Request object and call the correct methods to display the response.
     *
     * @param Request $request
     *
     * @throws InvalidTypeException
     * @throws NotExistsException
     */
    public function handleRequest(Request $request)
    {
        $router = $this->masterFactory->getHttpFactory()->getRouter();
        $router->parseUrl($request->getUrl());
        $request->addData($router->getQueryData());
        $builder = $this->masterFactory->getHttpFactory()->getControllerBuilder($request, $router);

        $builder->build();
        $controller = $builder->getController();
        $action = $builder->getAction();

        // Call action and get the response
        /** @var Response $response */
        $response = call_user_func_array([$controller, Controller::HANDLE], [$action]);

        // Send headers
        if (headers_sent() === false) {
            header(sprintf('Status: %s', Response::getMessageForCode($response->getStatus())));
            http_response_code($response->getStatus());

            //Send headers
            foreach ($response->getHeaders() as $name => $value) {
                header("$name: $value", false);
            }
        }

        // Print the body
        echo $response->getBody();
    }

    /**
     * Run the application. If there is an exception thrown send an 500.
     *
     * @param Request $request
     */
    public function run(Request $request)
    {
        try {
            $this->handleRequest($request);
        } catch (Exception $e) {
            $logger = $this->masterFactory->getDebugFactory()->getErrorLogger();
            $logger->error($e->getMessage().PHP_EOL.$e->getTraceAsString());

            header(sprintf('Status: %s', Response::getMessageForCode(500)));
            if (Settings::isDevMode()) {
                echo $e->getMessage().PHP_EOL;
                echo '<pre>';
                echo $e->getTraceAsString();
                echo '</pre>';
            }
        }
    }
}
