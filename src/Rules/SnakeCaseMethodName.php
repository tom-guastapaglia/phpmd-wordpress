<?php

namespace TomGuasta\PhpmdWordpress\Rules;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\MethodAware;


class SnakeCaseMethodName extends AbstractRule implements MethodAware
{
    protected $ignoredMethods = array(
        '__construct',
        '__destruct',
        '__set',
        '__get',
        '__call',
        '__callStatic',
        '__isset',
        '__unset',
        '__sleep',
        '__wakeup',
        '__toString',
        '__invoke',
        '__set_state',
        '__clone',
        '__debugInfo',
        '__serialize',
        '__unserialize',
    );

    /**
     * This method checks if the method name is snake_case
     *
     * @param AbstractNode $node
     * @return void
     */
    public function apply(AbstractNode $node)
    {
        $methodName = $node->getName();
        if (!in_array($methodName, $this->ignoredMethods)) {
            if (!preg_match('/^[a-z_]+$/', $methodName)) {
                $this->addViolation(
                    $node,
                    array(
                        $methodName,
                    )
                );
            }
        }
    }
}