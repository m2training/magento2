<?php

namespace Mageplaza\HelloWorld\Plugin;

class ExamplePlugin
{

	public function beforeSetTitle(\Mageplaza\HelloWorld\Controller\Index\Example $subject, $title)
	{
		$title = $title . " to ";
		echo __METHOD__ . "</br>";

		return [$title];
	}


	
	
}