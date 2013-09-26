<?php

class WBL_AbandonedCart_Block_Adminhtml_Dashboard extends Mage_Adminhtml_Block_Template
{
    public function __construct()
    {
        $this->_headerText = $this->__('Abandoned Cart Dashboard');
        parent::__construct();
        $this->setTemplate('wbl/abandonedcart/dashboard/index.phtml');

    }
    protected  function _prepareLayout()
    {
        $this->setChild('sales',
            $this->getLayout()->createBlock('wbl_abandonedcart/adminhtml_dashboard_sales')
        );
        $this->setChild('totals',
            $this->getLayout()->createBlock('wbl_abandonedcart/adminhtml_dashboard_totals')
        );


    }
    public function ajaxBlockAction()
    {
        $output   = '';
        $blockTab = $this->getRequest()->getParam('block');
        if (in_array($blockTab, array('totals'))) {
            $output = $this->getLayout()->createBlock('wbl_abandonedcart/adminhtml_dashboard_' . $blockTab)->toHtml();
        }
        $this->getResponse()->setBody($output);
        return;
    }
}
