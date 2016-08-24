<?php

namespace Core\Providers;

use Api\Twig\Extension\PaginationExtension;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Twig_Extension_Debug;
use Twig_Extensions_Extension_Text;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_SimpleFunction;

class TwigServiceProvider extends ServiceProvider
{
    public function provide(array $options = [])
    {
        $loader = new Twig_Loader_Filesystem($this->config['dir']);
        $twig = new Twig_Environment($loader, array(
            'cache' => $this->config['cache'],
            'auto_reload' => true,
            'debug' => true
        ));
        $twig->addExtension(new Twig_Extension_Debug());
        $twig->addExtension(new Twig_Extensions_Extension_Text());
        $twig->addExtension(new PaginationExtension());

        if (!isset($options['urlGenerator']) || false == $options['urlGenerator'] instanceof UrlGenerator) {
            throw new \Exception('twig provide must have urlGenerator');
        }

        $functionUrlGenerator = new Twig_SimpleFunction('url', function ($name, $parameters = []) use ($options) {
            return $options['urlGenerator']->generate($name, $parameters);
        });
        $functionGetPathInfo = new Twig_SimpleFunction('getPathInfo', function () use ($options) {
            return $options['getPathInfo'];
        });
        $twig->addFunction($functionUrlGenerator);
        $twig->addFunction($functionGetPathInfo);
        return $twig;
    }
}