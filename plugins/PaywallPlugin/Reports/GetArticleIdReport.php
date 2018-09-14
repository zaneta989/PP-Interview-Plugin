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
use Piwik\Plugins\PaywallPlugin\Columns\ArticleId;
use Piwik\View;

/**
 * This class defines a new report.
 *
 * See {@link http://developer.piwik.org/api-reference/Piwik/Plugin/Report} for more information.
 */
class GetArticleIdReport extends Base
{
    protected function init()
    {
        parent::init();

        $this->name          = Piwik::translate('PaywallPlugin_ArticleIdReport');
        $this->dimension     = new ArticleId();
        $this->documentation = Piwik::translate('');
        $this->order = 2;
        $this->subcategoryId = 'PaywallPlugin_ArticleIdReport';
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

    /**
     * @return string
     */
    public function render()
    {
        $view = new View('@PaywallPlugin/getArticleIdReport');

        return $view->render();
    }
}
