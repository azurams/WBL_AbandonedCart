<?php

class WBL_AbandonedCart_Model_System_Config_Discounttype
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = array(
          array('value'=> 1, 'label' => Mage::helper('wbl_abandonedcart')->__('Fixed amount')),
          array('value'=> 2, 'label' => Mage::helper('wbl_abandonedcart')->__('Percentage'))
        );
        return $options;
    }
    public function options()
    {
        $options[1] = Mage::helper('wbl_abandonedcart')->__('Fixed amount');
        $options[2] = Mage::helper('wbl_abandonedcart')->__('Percentage');
        return $options;
    }
}