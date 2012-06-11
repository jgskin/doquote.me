<?php

namespace Kpb\QuoteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Kpb\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;

class DefaultControllerTest extends WebTestCase
{
    public function testCreate()
    {
        //Test an unloged user in a protected area
        $client = static::createClient(array(), array('HTTP_HOST' => 'doquote.me'));
        $client->request('GET', '/create');
        $this->assertTrue($client->getResponse()->isRedirect('http://doquote.me/login'));
        
        //Test an logged in user
        $crawler = $client->request('GET', '/create', array(), array(), array('PHP_AUTH_USER' => 'test', 'PHP_AUTH_PW' => 'test'));
        
        var_dump($client->getResponse()->getContent()); die;

        $this->assertGreaterThan(0, $crawler->filter('form')->count());
    }
}