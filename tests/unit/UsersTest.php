<?php
require_once 'models/Users.php'; 
class UsersTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $password;
    
    protected function _before()
    {
        $this->password = 'alvanaMFB2018*';
    }

    protected function _after()
    {
        $this->password = '';
    }

    // tests
    public function testUsersModelFeature()
    {
        $users = new Users();
        $password_encrypted = $users->encryptPassword($this->password);
        $this->tester->assertEquals($password_encrypted, "YWx2YW5hTUZCMjAxOCo=", "The encrypted password is not same with the expected");
        //$success = $users->insert(['elah', 'YWx2YW5hTUZCMjAxOCo', "02/04/2020", 1], [PDO::PARAM_STR,
        //PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT]);
    }
}