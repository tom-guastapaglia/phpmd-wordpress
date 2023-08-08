<?php

namespace TomGuasta\PhpmdWordpress\Rules;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\FunctionAware;
use PHPMD\Rule\MethodAware;

class SnakeCaseParameterName extends AbstractRule implements MethodAware, FunctionAware
{
    /**
     * This method checks if the parameter name is snake_case
     *
     * @param AbstractNode $node
     * @return void
     */
    public function apply(AbstractNode $node)
    {
        foreach ($node->getParameters() as $parameter) {
            if (!preg_match('/^[a-z_]+$/', $parameter->getName())) {
                $this->addViolation(
                    $node,
                    array(
                        $parameter->getName(),
                    )
                );
            }
        }
    }

}