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
use Piwik\Plugin\Dimension\ActionDimension;
use Piwik\Tracker\Request;
use Piwik\Tracker\Visitor;
use Piwik\Tracker\Action;

/**
 * This example dimension recognizes a new tracking url parameter that is supposed to save the keywords that were used
 * on a certain page. Please note that dimension instances are usually cached during one tracking request so they
 * should be stateless (meaning an instance of this dimension will be reused if requested multiple times).
 *
 * See {@link http://developer.piwik.org/api-reference/Piwik/Plugin\Dimension\ActionDimension} for more information.
 */
class ArticleId extends ActionDimension
{
    /**
     * The name of the dimension which will be visible for instance in the UI of a related report and in the mobile app.
     * @return string
     */
    protected $nameSingular = 'PaywallPlugin_ArticleId';

    /**
     * This will be the name of the column in the log_link_visit_action table if a $columnType is specified.
     * @var string
     */
    protected $columnName = 'article_id';

    protected $columnType = 'INTEGER(11) DEFAULT NULL';

    protected $acceptValues = 'Here you should explain which values are accepted/useful for segments: Any number, for instance 1, 2, 3 , 99';

    public function onNewAction(Request $request, Visitor $visitor, Action $action)
    {
        if (empty($action)) {
            return false;
        }

        $value = Common::getRequestVar('cvar', false, 'json', $request->getParams());

        if(!$value) {
            return false;
        }

        $article = $this->flatten($value);

        if($article[0] === 'ArticleId') {
            return intval($article[1]);
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