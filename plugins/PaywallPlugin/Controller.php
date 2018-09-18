<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PaywallPlugin;

use Piwik\Plugins\PaywallPlugin\Widgets\GetArticleIdWidget;
use Piwik\Plugins\PaywallPlugin\Widgets\GetPaywallPlanWidget;

class Controller extends \Piwik\Plugin\Controller
{
    public function getPaywallPlanReport()
    {
        $w = new GetPaywallPlanWidget();
        return $w->render();
    }

    public function getArticleIdReport()
    {
        $w = new GetArticleIdWidget();
        return $w->render();
    }
}
