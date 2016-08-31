<?php

namespace Core;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;


class Framework
{
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;

    public function __construct(UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function handle(Request $request)
    {

        try {

            $path = explode('.', $request->getPathInfo());

            $format = $path[1] ?? 'html';

            $path = $path[0];

            $request->attributes->add($this->matcher->match($path));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            $controller[0]->setFormat($format);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            return new Response('Not Found' . $e->getMessage(), 404);
        } catch (\UnexpectedValueException $e) {
            return new Response(json_encode(['Forbidden ' => $e->getMessage()]), 403);
        } catch (\Exception $e) {
            return new Response('An error occurred ' . $e->getMessage(), 500);
        }
    }
}