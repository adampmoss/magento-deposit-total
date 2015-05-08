<?php

$installer  = new Mage_Core_Model_Resource_Setup;
$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable("sales/quote_address"), 'deposit_amount', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/quote_address"), 'base_deposit_amount', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Base Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/order"), 'deposit_amount', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/order"), 'base_deposit_amount', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Base Deposit Price'));

$installer->endSetup();