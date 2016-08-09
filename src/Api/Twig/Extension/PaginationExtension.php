<?php

namespace Api\Twig\Extension;

use Twig_Environment;
use Twig_Extension;
use Twig_Extension_InitRuntimeInterface;

class PaginationExtension extends Twig_Extension implements Twig_Extension_InitRuntimeInterface
{
    /**
     * @var \Twig_Environment
     */
    private $environment;

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('print_pagination', array($this, 'printPagination'), array('is_safe' => array
            ('html'))),
        );
    }

    public function getName()
    {
        return 'print_pagination';
    }

    public function initRuntime(Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function printPagination($totalRecords, $route, $page)
    {
        return $this->environment->render('Api/view/template/paginationWidget.html.twig', array(
            'total' => $totalRecords,
            'route' => $route,
            'page' => $page + 1
        ));
    }

}
