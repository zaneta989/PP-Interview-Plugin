<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PaywallPlugin;

use Piwik\Menu\MenuAdmin;
use Piwik\Menu\MenuTop;

class Menu extends \Piwik\Plugin\Menu
{
    public function configureTopMenu(MenuTop $menu)
    {
         $menu->addItem(
             'PaywallPlugin_PaywallPlanReport',
             null,
             $this->urlForAction('getPaywallPlanReport'),
             $orderId = 5
         );

        $menu->addItem(
            'PaywallPlugin_ArticleIdReport',
            null,
            $this->urlForAction('getArticleIdReport'),
            $orderId = 6
        );
    }

    public function configureAdminMenu(MenuAdmin $menu)
    {
    }
}
