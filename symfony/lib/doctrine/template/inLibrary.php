<?php
class inLibrary extends Doctrine_Template
{
	protected $_options = array();

	public function __construct(array $options = array())
	{
		$this->_options = $options;
	}
                              
                              
	public function setUp()
	{
		$this->addListener(new inLibraryListener($this->_options));
	}
}