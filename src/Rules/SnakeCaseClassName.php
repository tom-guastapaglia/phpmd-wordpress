<?php

namespace TomGuasta\PhpmdWordpress\Rules;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\ClassAware;
use PHPMD\Rule\EnumAware;
use PHPMD\Rule\InterfaceAware;
use PHPMD\Rule\TraitAware;

class SnakeCaseClassName extends AbstractRule implements ClassAware, InterfaceAware, TraitAware, EnumAware
{
    /**
     * This method checks if the class, interface, trait or enum name is Snake_Case
     *
     * @param AbstractNode $node
     * @return void
     */
    public function apply(AbstractNode $node)
    {
        if (!preg_match('/^(?:[A-Z][a-z0-9]*_)*[A-Z][a-z0-9]*$/', $node->getName())) {
            $this->addViolation($node,
            array(
                $node->getName(),
            ));
        }
    }
}