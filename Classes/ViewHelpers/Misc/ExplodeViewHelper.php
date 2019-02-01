<?php
declare(strict_types=1);
namespace In2code\Femanager\ViewHelpers\Misc;

use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class ExplodeViewHelper
 */
class ExplodeViewHelper extends AbstractViewHelper
{

    /**
     * Initialize
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('string', 'string', 'Any list (e.g. "a,b,c,d")', true, '');
        $this->registerArgument('separator', 'string', 'Separator sign (e.g. ",")', false, ',');
        $this->registerArgument('trim', 'boolean', 'Should be trimmed?', false, true);
    }

    /**
     * View helper to explode a list
     *
     * @return array
     */
    public function render(): array
    {
        return $this->arguments['trim'] ? GeneralUtility::trimExplode($this->arguments['separator'], $this->arguments['string'], true) : explode($this->arguments['separator'], $this->arguments['string']);
    }
}
