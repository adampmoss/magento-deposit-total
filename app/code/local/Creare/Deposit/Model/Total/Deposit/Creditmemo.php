<?php

class Creare_Deposit_Model_Total_Deposit_Creditmemo extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{

    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
	{
		$order = $creditmemo->getOrder();

		$depositAmountRemaining = $order->getDepositAmountInvoiced() - $order->getDepositAmountRefunded();
		$baseDepositAmountRemaining = $order->getBaseDepositAmountInvoiced() - $order->getBaseDepositAmountRefunded();
		if ($depositAmountRemaining > 0) {
			$creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $depositAmountRemaining);
			$creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseDepositAmountRemaining);
			$creditmemo->setDepositAmount($depositAmountRemaining);
			$creditmemo->setBaseDepositAmount($baseDepositAmountRemaining);
		}
		return $this;
	}
}