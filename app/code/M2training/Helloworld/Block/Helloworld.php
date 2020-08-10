<?php
namespace M2training\Helloworld\Block;

use Magento\Framework\View\Element\Template;

class Helloworld extends Template
{
    public function getHelloWorldText()
    {
        return 'Hello world!';
    }
}