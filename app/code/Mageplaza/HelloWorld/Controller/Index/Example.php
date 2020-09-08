<?php

namespace Mageplaza\HelloWorld\Controller\Index;

class Example extends \Magento\Framework\App\Action\Action
{

	protected $title;

	public function execute()
	{
		echo $this->setTitle('Welcome');
		echo $this->getTitle();
		//echo "Function Execute <BR/>";
	}

	public function setTitle($title)
	{
		//echo "Function Set Title test<BR/>";
		return $this->title = $title;
	}

	public function getTitle()
	{
		//echo "Function get Title 12334<BR/>";
		return $this->title;
	}
}
