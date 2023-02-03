<?php

namespace Binstellar\Productpdf\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Dompdf\Dompdf;

class Index extends \Magento\Framework\App\Action\Action {

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * @var Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $layout;

    protected $filesystem;

    protected $_storeManager;

    /**
     * @param Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\View\LayoutInterface $layout,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->_registry = $registry;
        $this->productRepository = $productRepository;
        $this->layout = $layout;
        $this->filesystem = $filesystem;
        $this->_storeManager = $storeManager;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    /**
     * Create PDF for product page.
     */
    public function execute()
    {
        $mediaPath = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath('exportpdf');
        $files = glob($mediaPath.'/*');
        foreach($files as $file) { 
            unlink($file);  
        } 

        if($params = $this->getRequest()->getParams())
        {
            $productId = $params['product_id'];
            $product_url = $params['product_url'];
            if (!$this->_registry->registry('product') && $productId) {
                $product = $this->productRepository->getById($productId);
                $this->_registry->register('product', $product);
            } else {
                $product = null;
            }

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $productpdf = $this->layout->createBlock('\Binstellar\Productpdf\Block\View',"",['data' => ['product' => $product,'product_url' => $product_url]])->setData('area','frontend')->setTemplate('Binstellar_Productpdf::product/view/productpdf.phtml')->toHtml();

            $processor = $objectManager->create('Magento\Cms\Model\Template\FilterProvider');
            $finalpdf = $processor->getBlockFilter()->filter($productpdf);

            $dompdf = new Dompdf();
                        
            $dompdf->load_html($finalpdf);
            $dompdf->set_option('isRemoteEnabled', TRUE);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $output = $dompdf->output();
           
            $pdfFile = file_put_contents($mediaPath . "/55769173749019332.pdf", $output);

            $result = $this->resultJsonFactory->create();
            $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            $downloadPath = $mediaUrl.'exportpdf/55769173749019332.pdf';
            return $result->setData($downloadPath);

        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}