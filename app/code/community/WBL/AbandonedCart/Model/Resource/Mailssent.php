<?php

class WBL_AbandonedCart_Model_Resource_Mailssent extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('wbl_abandonedcart/mailssent','id');
    }

}