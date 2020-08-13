<?php
namespace Mageplaza\HelloWorld\Block;



class ChangeText extends \Cognizant\HelloWorld\Block\Hello
{
    public function getText() {
        return "Changed Text -  Preference Override";
    }
}