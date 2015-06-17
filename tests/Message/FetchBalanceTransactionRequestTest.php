<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class FetchBalanceTransactionRequestTest extends TestCase
{
    /**
     * @var FetchTokenRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = new FetchBalanceTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setBalanceTransaction('txn_123oozFBPiYqm8LsUK6Babcd');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/balance/history/txn_123oozFBPiYqm8LsUK6Babcd', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchBalanceTransactionSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
        $this->assertEquals(342, $response->getStripeFee());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('FetchBalanceTransactionFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getStripeFee());

        $this->assertSame('No such balancetransaction: txn_123oozFBPiYqm8LsUK6Babcd', $response->getMessage());
    }
}
