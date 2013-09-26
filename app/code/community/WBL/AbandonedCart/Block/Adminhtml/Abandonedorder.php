<?php

class WBL_AbandonedCart_Block_Adminhtml_Abandonedorder extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. foo_bar/adminhtml_baz
        $this->_blockGroup = 'wbl_abandonedcart';
        $this->_controller = 'adminhtml_abandonedorder';
        $this->_headerText = $this->__('Orders made from abandoned carts');

        parent::__construct();
        $this->removeButton('add');

    }

}