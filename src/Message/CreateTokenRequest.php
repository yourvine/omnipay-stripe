<?php
/**
 * Stripe Fetch Token Request
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Fetch Token Request
 *
 * @link https://stripe.com/docs/api#tokens
 */
class CreateTokenRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();

        if ($this->getCard()) {
            $data['card'] = $this->getCardData();
        } else {
            $this->validate('card');
        }

        return $data;
    }


    protected function getCardData()
    {
        $this->getCard()->validate();

        $data = array();
        $data['number'] = $this->getCard()->getNumber();
        $data['exp_month'] = $this->getCard()->getExpiryMonth();
        $data['exp_year'] = $this->getCard()->getExpiryYear();
        $data['cvc'] = $this->getCard()->getCvv();
        $data['name'] = $this->getCard()->getName();
        $data['address_line1'] = $this->getCard()->getAddress1();
        $data['address_line2'] = $this->getCard()->getAddress2();
        $data['address_city'] = $this->getCard()->getCity();
        $data['address_zip'] = $this->getCard()->getPostcode();
        $data['address_state'] = $this->getCard()->getState();
        $data['address_country'] = $this->getCard()->getCountry();

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/tokens';
    }

    public function getHttpMethod()
    {
        return 'POST';
    }
}
