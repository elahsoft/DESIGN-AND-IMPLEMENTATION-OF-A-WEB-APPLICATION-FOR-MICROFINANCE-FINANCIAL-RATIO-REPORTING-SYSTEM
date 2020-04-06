<?php 
require_once 'models/AdjustedReturnOnAssets.php';
class AdjustedReturnOnAssetsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $adjusted_net_operating_income, $taxes, $adjusted_average_assets = 0;

    protected function _before()
    {
        $this->adjusted_net_operating_income = 70000000;
        $this->taxes = 2000000;
        $this->adjusted_average_assets = 500000;
    }

    protected function _after()
    {
        $this->adjusted_net_operating_income = 0;
        $this->taxes = 0;
        $this->adjusted_average_assets = 0;
    }

    // tests
    public function testAdjustedReturnOnAssetsFunctions()
    {
        $adjustedReturnOnAssets = new AdjustedReturnOnAssets();
        $adjusted_return_on_assets = $adjustedReturnOnAssets->computeAdjustedReturnOnAssets(
            $this->adjusted_net_operating_income, $this->taxes, $this->adjusted_average_assets);
        $this->tester->assertEquals(136, $adjusted_return_on_assets, "The Function for Adjusted Return On Assets has an error");

    }
}