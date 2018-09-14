<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PaywallPlugin\Reports;

use Piwik\Piwik;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\PaywallPlugin\Columns\PaywallPlan;
use Piwik\Report\ReportWidgetFactory;
use Piwik\View;
use Piwik\Widget\WidgetsList;

/**
 * This class defines a new report.
 *
 * See {@link http://developer.piwik.org/api-reference/Piwik/Plugin/Report} for more information.
 */
class GetPaywallPlanReport extends Base
{
    protected function init()
    {
        parent::init();

        $this->name          = 'PaywallPlugin_PaywallPlanReport';
        $this->dimension     = new PaywallPlan();
        $this->documentation = Piwik::translate('');
        $this->order = 1;
        $this->subcategoryId = 'PaywallPlugin_PaywallPlanReport';
    }

    /**
     * @param ViewDataTable $view
     */
    public function configureView(ViewDataTable $view)
    {
        if (!empty($this->dimension)) {
            $view->config->addTranslations(array('label' => $this->dimension->getName()));
        }

        $view->config->columns_to_display = array_merge(array('label'), $this->metrics);
    }

    /**
     * @return \Piwik\Plugin\Report[]
     */
    public function getRelatedReports()
    {
        return array();
    }

    public function render()
    {
        $view = new View('@PaywallPlugin/getPaywallPlanReport');

        return $view->render();
    }

    public function configureWidgets(WidgetsList $widgetsList, ReportWidgetFactory $factory)
    {
       $widgetsList->addWidgetConfig($factory->createWidget());
    }
}
