<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 08.08.16
 * Time: 13:43
 */

namespace Core\Providers;


abstract class ServiceProvider
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    abstract public function provide(array $options = []);
}