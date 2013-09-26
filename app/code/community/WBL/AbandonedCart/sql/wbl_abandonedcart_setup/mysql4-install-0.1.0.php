<?php

$installer = $this;

$installer->startSetup();

//New Table
$installer->run("
	CREATE TABLE IF NOT EXISTS `{$this->getTable('wbl_mails_sent')}` (
	  `id` INT(10) unsigned NOT NULL auto_increment,
	  `store_id` smallint(5),
	  `mail_type` ENUM('abandoned cart','happy order birthday') NOT NULL,
	  `customer_email` varchar(255),
	  `customer_name` varchar(255),
	  `coupon_number` varchar(255),
	  `coupon_type` smallint(2),
	  `coupon_amount` decimal(10,2),
      `sent_at` DATETIME NOT NULL ,
	  PRIMARY KEY  (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

//Order new field
$installer->getConnection()->addColumn(
    $installer->getTable('sales_flat_order'), 'wbl_abandonedcart_flag', 'int(1)', null, array('default' => '0')
);

//Quote new fields
$installer->getConnection()->addColumn(
    $installer->getTable('sales_flat_quote'), 'wbl_abandonedcart_flag', 'int(5)', null, array('default' => '0','nullable' => false)
);

$installer->getConnection()->addColumn(
    $installer->getTable('sales_flat_quote'), 'wbl_abandonedcart_counter', 'int(5)', null, array('default' => '0','nullable' => false)
);

$installer->getConnection()->addColumn(
    $installer->getTable('sales_flat_quote'), 'wbl_abandonedcart_token', 'varchar(255)', null, array('default' => 'null')
);


$installer->run("
	 ALTER TABLE  `{$this->getTable('sales_flat_quote')}` CHANGE `wbl_abandonedcart_counter` `wbl_abandonedcart_counter` INT( 5 ) NOT NULL DEFAULT '0';
	 ALTER TABLE  `{$this->getTable('sales_flat_quote')}` CHANGE `wbl_abandonedcart_flag` `wbl_abandonedcart_flag` INT( 5 ) NOT NULL DEFAULT '0';
");

$installer->endSetup();
