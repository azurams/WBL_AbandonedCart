<?php

class WBL_AbandonedCart_Block_Adminhtml_Abandonedmails extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. foo_bar/adminhtml_baz
        $this->_blockGroup = 'wbl_abandonedcart';
        $this->_controller = 'adminhtml_abandonedmails';
        $this->_headerText = $this->__('Mails sent for abandoned carts');

        parent::__construct();
        $this->removeButton('add');

    }

}