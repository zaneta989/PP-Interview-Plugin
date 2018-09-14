<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\PaywallPlugin;

use Piwik\Archive;
use Piwik\DataTable;

/**
 * API for plugin PaywallPlugin
 *
 * @method static \Piwik\Plugins\PaywallPlugin\API getInstance()
 */
class API extends \Piwik\Plugin\API
{
    /**
     * Another example method that returns a data table.
     * @param int    $idSite
     * @param string $period
     * @param string $date
     * @param bool|string $segment
     * @return DataTable
     */
    public function getPaywallPlanReport($idSite, $period, $date, $segment = false)
    {
        $archive = Archive::build($idSite, $period, $date, $segment);
        $dt = $archive->getDataTable('PaywallPlugin_archive_paywall_record');

        return $dt;
    }

    /**
     * Another example method that returns a data table.
     * @param int    $idSite
     * @param string $period
     * @param string $date
     * @param bool|string $segment
     * @return DataTable
     */
    public function getArticleIdReport($idSite, $period, $date, $segment = false)
    {
        $archive = Archive::build($idSite, $period, $date, $segment);
        $dt = $archive->getDataTable('PaywallPlugin_archive_article_record');

        return $dt;
    }

}
