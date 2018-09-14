<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PaywallPlugin\tests\System;

use Piwik\Plugins\PaywallPlugin\tests\Fixtures\PaywallPlanVisit;
use Piwik\Plugins\PaywallPlugin\tests\Fixtures\SimpleFixtureTrackFewVisits;
use Piwik\Tests\Framework\TestCase\SystemTestCase;

/**
 * @group PaywallPlugin
 * @group ApiPaywallPlanTest
 * @group Plugins
 */
class ApiPaywallPlanTest extends SystemTestCase
{
    /**
     * @dataProvider getApiForTesting
     */
    /**
     * @var PaywallPlanVisit
     */
    public static $fixture = null;

    public function testApi($api, $params)
    {
        $this->runApiTests($api, $params);
    }

    public function getApiForTesting()
    {
        $idSite = self::$fixture->idSite;

        return array(
            array('PaywallPlugin.getPaywallPlanReport', array('idSite' => $idSite, 'periods' => array('day'), 'date' => 'today')),
            array('PaywallPlugin.getPaywallPlanReport', array('idSite' => $idSite, 'periods' => array('week'), 'date' => '2018-09-01'))
        );
    }

    public static function getOutputPrefix()
    {
        return '';
    }

    public static function getPathToTestDirectory()
    {
        return dirname(__FILE__);
    }
}

ApiPaywallPlanTest::$fixture = new PaywallPlanVisit();
