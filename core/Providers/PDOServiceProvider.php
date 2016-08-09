<?php

namespace Core\Providers;

use PDO;
use PDOException;


class PDOServiceProvider extends ServiceProvider
{

    public function provide(array $options = [])
    {
        try {
            $db = new PDO(
                "mysql:dbname=" . $this->config['dbname'] . ";
                host=localhost",
                $this->config['user'],
                $this->config['password']
            );

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $err) {
            echo '<pre>';
            print_r($err->getMessage());
            print_r($err->getLine());
            die;
        }
        return $db;
    }
}