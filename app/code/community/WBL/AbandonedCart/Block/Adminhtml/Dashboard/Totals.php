<?php

class WBL_AbandonedCart_Block_Adminhtml_Dashboard_Totals extends Mage_Adminhtml_Block_Dashboard_Bar
{
    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('wbl/abandonedcart/dashboard/totalbar.phtml');
    }

    /**
     * @return WBL_AbandonedCart_Block_Adminhtml_Dashboard_Totals|Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        if (!Mage::helper('core')->isModuleEnabled('Mage_Reports')) {
            return $this;
        }
        $isFilter = $this->getRequest()->getParam('store') || $this->getRequest()->getParam('website') || $this->getRequest()->getParam('group');
        $period = $this->getRequest()->getParam('period', '24h');

        $collection = Mage::getResourceModel('wbl_abandonedcart/order_collection')
                            ->addCreateAtPeriodFilter($period)
                            ->calculateTotals($isFilter);
        $collection->addFieldToFilter('main_table.wbl_abandonedcart_flag',array('eq' => 1));



        if ($this->getRequest()->getParam('store')) {
            $collection->addFieldToFilter('main_table.store_id', $this->getRequest()->getParam('store'));
        } else if ($this->getRequest()->getParam('website')){
            $storeIds = Mage::app()->getWebsite($this->getRequest()->getParam('website'))->getStoreIds();
            $collection->addFieldToFilter('main_table.store_id', array('in' => $storeIds));
        } else if ($this->getRequest()->getParam('group')){
            $storeIds = Mage::app()->getGroup($this->getRequest()->getParam('group'))->getStoreIds();
            $collection->addFieldToFilter('main_table.store_id', array('in' => $storeIds));
        } elseif (!$collection->isLive()) {
            $collection->addFieldToFilter('main_table.store_id',
                array('eq' => Mage::app()->getStore(Mage_Core_Model_Store::ADMIN_CODE)->getId())
            );
        }

        $collection->load();

        $totals = $collection->getFirstItem();


        $collection2 = Mage::getResourceModel('wbl_abandonedcart/order_collection')
            ->addCreateAtPeriodFilter($period)
            ->calculateTotals($isFilter);
        if ($this->getRequest()->getParam('store')) {
            $collection2->addFieldToFilter('store_id', $this->getRequest()->getParam('store'));
        } else if ($this->getRequest()->getParam('website')){
            $storeIds = Mage::app()->getWebsite($this->getRequest()->getParam('website'))->getStoreIds();
            $collection2->addFieldToFilter('store_id', array('in' => $storeIds));
        } else if ($this->getRequest()->getParam('group')){
            $storeIds = Mage::app()->getGroup($this->getRequest()->getParam('group'))->getStoreIds();
            $collection2->addFieldToFilter('store_id', array('in' => $storeIds));
        } elseif (!$collection2->isLive()) {
            $collection->addFieldToFilter('store_id',
                array('eq' => Mage::app()->getStore(Mage_Core_Model_Store::ADMIN_CODE)->getId())
            );
        }

        $collection2->load();

        $totals2 = $collection2->getFirstItem();

        // add totals for generated orders
        if($totals2->getQuantity()) {
            $convrate = (string)($totals->getQuantity()*100/$totals2->getQuantity());
            $convrate = round($convrate*100)/100;
        }
        else {
            $convrate = 0;
        }
        $this->addTotal($this->__('Generated Revenue'),$totals->getRevenue());
        $this->addTotal($this->__('Generated Tax'), $totals->getTax());
        $this->addTotal($this->__('Generated Shipping'), $totals->getShipping());
        $this->addTotal($this->__('Generated Orders'),$totals->getQuantity()*1,true);
        $this->addTotal($this->__('Generated Conv. Rate'),$convrate.'%',true);

    }
}