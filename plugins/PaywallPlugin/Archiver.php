<?php
/**
 * Created by PhpStorm.
 * User: zaneta
 * Date: 17.09.18
 * Time: 19:09
 */

namespace Piwik\Plugins\PaywallPlugin;

use Piwik\DataTable;
use Piwik\Metrics;
use Piwik\Piwik;

class Archiver extends \Piwik\Plugin\Archiver
{
    public function aggregateDayReport()
    {
       $this->getPaywallPlan();
       $this->getArticle();
    }

    public function aggregateMultipleReports()
    {
        $archiveProcessor = $this->getProcessor();
        $archiveProcessor->aggregateDataTableRecords('PaywallPlugin_archive_paywalls_record', 500);
    }

    private function getPaywallPlan()
    {
        $logAggregator = $this->getLogAggregator();
        $query = $logAggregator->queryVisitsByDimension(['paywall_plan']);
        $dt = new DataTable();
        foreach ($query->fetchAll() as $id => $row) {
            $dt->addRowFromSimpleArray(array(
                'label' => Piwik::translate('PaywallPlugin_PaywallPlan'). ' ' . $row['paywall_plan'],
                'nb_visits' => $row[Metrics::INDEX_NB_VISITS]
            ));
        }

        $archiveProcessor = $this->getProcessor();

        $archiveProcessor->insertBlobRecord(
            'PaywallPlugin_archive_paywall_record',
            $dt->getSerialized(1000)
        );
    }

    private function getArticle()
    {
        $logAggregator = $this->getLogAggregator();
        $query = $logAggregator->queryActionsByDimension(['article_id']);
        $dt = new DataTable();
        foreach ($query->fetchAll() as $id => $row) {
            $dt->addRowFromSimpleArray(array(
                'label' => Piwik::translate('PaywallPlugin_ArticleId'). ' ' . $row['article_id'],
                'nb_actions' => $row[Metrics::INDEX_NB_ACTIONS]
            ));
        }

        $archiveProcessor = $this->getProcessor();

        $archiveProcessor->insertBlobRecord(
            'PaywallPlugin_archive_article_record',
            $dt->getSerialized(1000)
        );
    }
}
