<?php
/*
 * This file is part of the Truckee\Match package.
 * 
 * (c) George W. Brooks
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//src\Truckee\MatchBundle\Tests\Controller\StaffControllerTest.php

namespace Truckee\MatchBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * StaffControllerTest
 *
 */
class StaffControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
//        self::bootKernel();
//        $this->em = static::$kernel->getContainer()
//            ->get('doctrine')
//            ->getManager()
//        ;
//        $this->tool = static::$kernel->getContainer()
//            ->get('truckee_match.toolbox')
//        ;

        $classes = array(
            'Truckee\MatchBundle\DataFixtures\Test\LoadFocusSkillData',
            'Truckee\MatchBundle\DataFixtures\Test\LoadMinimumData',
            'Truckee\MatchBundle\DataFixtures\Test\LoadStaffUserGlenshire',
            'Truckee\MatchBundle\DataFixtures\Test\LoadStaffUserMelanzane',
            'Truckee\MatchBundle\DataFixtures\Test\LoadOpportunity',
            'Truckee\MatchBundle\DataFixtures\Test\LoadVolunteer',
            'Truckee\MatchBundle\DataFixtures\Test\LoadStaffUserBorko',
            'Truckee\MatchBundle\DataFixtures\Test\LoadTurkeyOpportunity',
        );
        $this->loadFixtures($classes);
        $this->client = $this->createClient();
        $this->client->followRedirects();
//        file_put_contents("G:\\Documents\\response.html", $this->client->getResponse()->getContent());
    }

    public function login($user)
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = $user;
        $form['_password'] = '123Abcd';
        $crawler = $this->client->submit($form);

        return $crawler;
    }

    public function testOpportunityAdd()
    {
        $crawler = $this->login('jglenshire');
        $crawler = $this->client->request('GET', '/opp/new');
        $form = $crawler->selectButton('Save opportunity')->form();
        $form['opportunity[active]']->tick();
        $form['opportunity[oppName]'] = 'Frog';
        $form['opportunity[description]'] = 'Knee deep';
        $crawler = $this->client->submit($form);

        $this->assertGreaterThan(0,
            $crawler->filter('html:contains("Opportunity added")')->count());
    }
}
