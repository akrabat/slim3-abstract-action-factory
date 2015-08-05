<?php
namespace App;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ActionAbstractFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName)
    {
        if (substr($requestedName, -6) == 'Action') {
            // This abstract factory will create any class that ends with the word "Action"
            return true;
        }

        return false;
    }
 
    public function createServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName)
    {
        $className = $requestedName;

        // This factory creates Actions that have precisely two constructor parameters: $view & $logger
        $view = $locator->get('view');
        $logger = $locator->get('logger');
        
        return new $className($view, $logger);
    }
}
