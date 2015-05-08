<?php

$installer  = new Mage_Core_Model_Resource_Setup;
$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable("sales/invoice"), 'deposit_amount', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/invoice"), 'base_deposit_amount', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Base Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/creditmemo"), 'deposit_amount', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/creditmemo"), 'base_deposit_amount', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Base Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/order"), 'deposit_amount_refunded', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/order"), 'base_deposit_amount_refunded', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Base Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/order"), 'deposit_amount_invoiced', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Deposit Price'));

$installer->getConnection()->addColumn($installer->getTable("sales/order"), 'base_deposit_amount_invoiced', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'comment' => 'Base Deposit Price'));

$installer->endSetup();