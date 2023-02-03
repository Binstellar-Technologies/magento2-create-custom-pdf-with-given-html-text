<?php
namespace Binstellar\Productpdf\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;

class View extends Template
{
    /**
     * Product Model
     *
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productFactory;

    protected $_registry;

    /**
    * @param \Magento\Catalog\Model\ProductFactory $productFactory
    * @param array $data
    */

    public function __construct(
        Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Framework\Registry $registry,
        array $data = []
    ){
        $this->_registry = $registry;
        $this->_productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    public function getCurrentProduct()
    {       
        return $this->_registry->registry('current_product');
    }
}