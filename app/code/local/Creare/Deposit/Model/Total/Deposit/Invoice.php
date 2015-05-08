<?php
class Creare_Deposit_Model_Total_Deposit_Invoice extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
    	$order = $invoice->getOrder();

    	$depositAmountRemaining = $order->getDepositAmount() - $order->getDepositAmountInvoiced();
		$baseDepositAmountRemaining = $order->getBaseDepositAmount() - $order->getBaseDepositAmountInvoiced();

        if (abs($baseDepositAmountLeft) < $invoice->getBaseGrandTotal()) {
			$invoice->setGrandTotal($invoice->getGrandTotal() + $depositAmountRemaining);
			$invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseDepositAmountRemaining);
		} else {
			$depositAmountRemaining = $invoice->getGrandTotal() * -1;
			$baseDepositAmountRemaining = $invoice->getBaseGrandTotal() * -1;

			$invoice->setGrandTotal(0);
			$invoice->setBaseGrandTotal(0);
		}

        $invoice->setDepositAmount($depositAmountRemaining);
		$invoice->setBaseDepositAmount($baseDepositAmountRemaining);

        return $this;
    }
}