<?php

namespace Mageplaza\HelloWorld\Controller\Index;

class Example extends \Magento\Framework\App\Action\Action
{

	protected $title;

	public function execute()
	{
		echo $this->setTitle('Welcome');
		echo $this->getTitle();
		echo "Function Execute";
	}

	public function setTitle($title)
	{
		echo "Function Set Title";
		return $this->title = $title;
	}

	public function getTitle()
	{
		echo "Function get Title";
		return $this->title;
	}
}
