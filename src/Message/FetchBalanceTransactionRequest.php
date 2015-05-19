<?php
/**
 * Stripe Fetch Transaction Request
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Fetch Balance Transaction Request Request
 *
 * Example -- note this example assumes that the purchase has been successful
 * and that the transaction ID returned from the purchase is held in $sale_id.
 * See PurchaseRequest for the first part of this example transaction:
 *
 * <code>
 *   // Fetch the transaction so that details can be found for refund, etc.
 *   $transaction = $gateway->fetchTransaction();
 *   $transaction->setTransactionReference($sale_id);
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchTransaction response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see PurchaseRequest
 * @see Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api#retrieve_charge
 */
class FetchBalanceTransactionRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('balanceTransaction');
        $data = [];
        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/balance/history/'.$this->getParameter('balanceTransaction');
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }

    /**
     * @param string $balanceTransaction
     */
    public function setBalanceTransaction($balanceTransaction)
    {
        $this->parameters->set('balanceTransaction', $balanceTransaction);

    }

    /**
     * @return string
     */
    public function getBalanceTransaction()
    {
        return $this->parameters->get('balanceTransaction');
    }
}
