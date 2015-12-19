<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
*/
class PopulatedTester extends \Codeception\Actor
{
    use _generated\PopulatedTesterActions;

     public function login($name)
    {
        $I = $this;
        $I->amOnPage('/login');
        $I->fillField('#username', $name);
        $I->fillField('#password', '123Abcd');
        $I->click('#_submit');
        $I->see('Welcome');
    } 
}
