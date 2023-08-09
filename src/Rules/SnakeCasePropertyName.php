<?php

namespace TomGuasta\PhpmdWordpress\Rules;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\ClassAware;
use PHPMD\Rule\TraitAware;

class SnakeCasePropertyName extends AbstractRule implements ClassAware, TraitAware
{
    /**
     * This method checks if the property name is snake_case
     *
     * @param AbstractNode $node
     * @return void
     */
    public function apply(AbstractNode $node)
    {
        $pattern = '/^\$[a-z_]+$/';

        foreach ($node->getProperties() as $property) {
            $propertyName = $property->getName();

            if (!preg_match($pattern, $propertyName)) {
                $this->addViolation(
                    $node,
                    array(
                        $propertyName,
                    )
                );
            }
        }
    }
}