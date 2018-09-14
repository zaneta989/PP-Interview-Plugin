<?php
/**
 * Created by PhpStorm.
 * User: zaneta
 * Date: 17.09.18
 * Time: 22:19
 */

namespace Piwik\Plugins\PaywallPlugin\tests\Fixtures;

use Piwik\Tests\Framework\Fixture;

class PaywallPlanVisit extends Fixture
{
    /**
     * @var string
     */
    public $dateTime;

    /**
     * @var int
     */
    public $idSite = 1;

    public function setUp()
    {
        $this->dateTime = new \DateTime('now');
        $this->setUpWebsite();
        $this->trackVisits();

    }
    private function setUpWebsite()
    {
        self::createWebsite($this->dateTime);
    }
    /**
     * @throws \Exception
     */
    protected function trackVisits()
    {
        $tracker = self::getTracker(1, $this->dateTime, true, true);
        $number = [27, 24, 27, 23];

        for ($i = 0; $i < 4; $i++) {
            $tracker->setForceNewVisit(true);
            $tracker->setUrl('http://piwik.net/index.php?_cvar='.$this->getPaywallPlan($number[$i]));
            $pageview = $tracker->doTrackPageView('Viewing homepage ' . rand(0, 10000));

            self::checkResponse($pageview);
        }
    }

    protected function getPaywallPlan($number)
    {
        $array = [1 => ["PaywallPlan", $number]];
        $json = json_encode($array);
        $url = urlencode($json);

        return $url;
    }
}