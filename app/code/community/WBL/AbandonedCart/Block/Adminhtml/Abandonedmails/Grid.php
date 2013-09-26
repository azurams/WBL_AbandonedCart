<?php

class WBL_AbandonedCart_Block_Adminhtml_Abandonedmails_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('id');
        $this->setId('wbl_abandonedcart_abandonedmails_grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        return 'wbl_abandonedcart/mailssent_collection';
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {

        $this->addColumn('store', array(
            'header' => Mage::helper('wbl_abandonedcart')->__('Store'),
            'type' => 'store',
            'index' => 'store_id'
        ));

        $this->addColumn('sent_at', array(
            'header' => Mage::helper('wbl_abandonedcart')->__('Sent At'),
            'index' => 'sent_at',
            'filter_index' => 'sent_at',
            'type' => 'datetime',
            'width' => '100px',
        ));

        $this->addColumn('customer_email', array(
            'header' => Mage::helper('wbl_abandonedcart')->__('Customer Email'),
            'index' => 'customer_email',
        ));

        $this->addColumn('customer_name', array(
            'header' => Mage::helper('wbl_abandonedcart')->__('Customer Name'),
            'index' => 'customer_name',
        ));

        $this->addColumn('mail_type', array(
            'header' => Mage::helper('wbl_abandonedcart')->__('Mail Type'),
            'index' => 'mail_type',
            'type' => 'options',
            'options' => $this->getMailTypeOptions(),
        ));
        $this->addColumn('coupon', array(
            'header' => Mage::helper('wbl_abandonedcart')->__('Coupon #'),
            'index' => 'coupon_number',
        ));
        $this->addColumn('coupon_type', array(
            'header' => Mage::helper('wbl_abandonedcart')->__('Coupon type'),
            'type' => 'options',
            'index' => 'coupon_type',
            'options' => Mage::getModel('WBL_AbandonedCart_Model_System_Config_Discounttype')->options(),
        ));
        $this->addColumn('coupon_amount', array(
            'header' => Mage::helper('wbl_abandonedcart')->__('Coupon amount'),
            'index' => 'coupon_amount',
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel XML'));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    protected function getMailTypeOptions()
    {
        return array('abandoned cart'=>'abandoned cart','happy birthday'=>'happy birthday','new order'=>'new order', 'related products'=>'related products', 'product review'=>'product review', 'no activity'=>'no activity', 'wishlist'=>'wishlist');
    }

}