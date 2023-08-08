<?php

namespace TomGuasta\PhpmdWordpress\Rules;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\FunctionAware;
use PHPMD\Rule\MethodAware;

class SnakeCaseVariableName extends AbstractRule implements MethodAware, FunctionAware
{
    /**
     * @var array
     */
    protected $exceptions = array(
        '$php_errormsg',
        '$http_response_header',
        '$GLOBALS',
        '$_SERVER',
        '$_GET',
        '$_POST',
        '$_FILES',
        '$_COOKIE',
        '$_SESSION',
        '$_REQUEST',
        '$_ENV',
    );

    /**
     * This method checks if the variable name is snake_case
     *
     * @param AbstractNode $node
     * @return void
     */
    public function apply(AbstractNode $node)
    {
        foreach ($node->findChildrenOfTypeVariable() as $variable) {
            if (!$this->isValid($variable)) {
                $this->addViolation(
                    $node,
                    array(
                        $variable->getImage(),
                    )
                );
            }
        }
    }

    protected function isValid($variable)
    {
        $image = $variable->getImage();

        if (in_array($image, $this->exceptions)) {
            return true;
        }

        if (preg_match('/^[a-z_]+$/', $image)) {
            return true;
        }

        if ($variable->getParent()->isInstanceOf('PropertyPostfix')) {
            return true;
        }

        return false;
    }
}