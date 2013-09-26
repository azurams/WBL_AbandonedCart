<?php

class WBL_AbandonedCart_Model_System_Config_Customergroup
{
    protected $_options;

    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('customer/group_collection')
                ->loadData()->toOptionArray();
        }
        return $this->_options;
    }
}
