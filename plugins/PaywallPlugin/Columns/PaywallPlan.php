<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\PaywallPlugin\Columns;

use Piwik\Common;
use Piwik\Plugin\Dimension\VisitDimension;
use Piwik\Tracker\Request;
use Piwik\Tracker\Visitor;
use Piwik\Tracker\Action;

/**
 * This example dimension counts achievement points for each user. A user gets one achievement point for each action
 * plus five extra achievement points for each conversion. This would allow you to create a ranking showing the most
 * active/valuable users. It is just an example, you can log pretty much everything and even just store any custom
 * request url property. Please note that dimension instances are usually cached during one tracking request so they
 * should be stateless (meaning an instance of this dimension will be reused if requested multiple times).
 *
 * See {@link http://developer.piwik.org/api-reference/Piwik/Plugin\Dimension\VisitDimension} for more information.
 */
class PaywallPlan extends VisitDimension
{
    protected $columnName = 'paywall_plan';

    protected $columnType = 'INTEGER(11) DEFAULT NULL';

    protected $nameSingular = 'PaywallPlugin_PaywallPlan';

    protected $acceptValues = 'Here you should explain which values are accepted/useful for segments: Any number, for instance 1, 2, 3 , 99';

    /**
     * @param Request $request
     * @param Visitor $visitor
     * @param Action|null $action
     * @return mixed|false
     */
    public function onNewAction(Request $request, Visitor $visitor, $action)
    {
        if (empty($action)) {
            return false;
        }

        $value = Common::getRequestVar('_cvar', false, 'json', $request->getParams());

        if(!$value) {
            return false;
        }

        $paywall = $this->flatten($value);

        if($paywall[0] === 'PaywallPlan') {
            return intval($paywall[1]);
        }

        return false;
    }

    private function flatten(array $array) {
        $return = array();

        array_walk_recursive(
            $array,
            function($a) use (&$return) {
                $return[] = $a;
            }
        );

        return $return;
    }
}