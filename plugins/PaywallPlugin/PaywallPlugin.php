<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PaywallPlugin;

use Piwik\Plugin\ViewDataTable;

class PaywallPlugin extends \Piwik\Plugin
{
    public function registerEvents()
    {
        return array(
            'ViewDataTable.configure' => 'configureViewDataTable'
        );
    }

    public function configureViewDataTable(ViewDataTable $view)
    {
        switch ($view->requestConfig->apiMethodToRequestDataTable) {
            case 'PaywallPlugin.getPaywallPlanReport':
                $view->config->show_limit_control = true;
                $view->config->show_search = false;
                $view->config->show_goals = false;
                $view->config->columns_to_display = array('label', 'nb_visits');
                break;
            case 'PaywallPlugin.getArticleIdReport':
                $view->config->show_limit_control = true;
                $view->config->show_search = false;
                $view->config->show_goals = false;
                $view->config->columns_to_display = array('label', 'nb_actions');
                break;
        }
    }

}
