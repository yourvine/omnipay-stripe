<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class CreateTokenRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new CreateTokenRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setCard($this->getValidCard());
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/tokens', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateTokenSuccess.txt');
        $response = $this->request->send();


        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('tok_15pMrqFBPiYqm8LsS8HQFcq7', $response->getToken());
        $this->assertNull($response->getCardReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('CaptureFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getCardReference());
        $this->assertSame('Charge ch_1lvgjcQgrNWUuZ has already been captured.', $response->getMessage());
    }
}
