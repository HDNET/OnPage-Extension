<?php
/**
 * Class PriorityViewHelper
 */

namespace HDNET\OnpageIntegration\ViewHelpers;

/**
 * Class PriorityViewHelper
 */
class PriorityViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Generates the html output for
     * the priority ranking
     *
     * @param string $priority
     *
     * @return null|string
     */
    public function render($priority)
    {
        $html = null;
        for ($i = 0; $i < $priority; $i++) {
            $html .= "<span class=\"glyphicon glyphicon-asterisk\"></span>";
        }
        return $html;
    }
}