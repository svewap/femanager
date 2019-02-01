<?php
declare(strict_types=1);
namespace In2code\Femanager\ViewHelpers\Misc;

use In2code\Femanager\Utility\BackendUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class BackendEditLinkViewHelper
 */
class BackendEditLinkViewHelper extends AbstractViewHelper
{

    /**
     * Initialize
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('tableName', 'string', '', true);
        $this->registerArgument('identifier', 'int', '', true);
        $this->registerArgument('addReturnUrl', 'boolean', '', true, true);
    }

    /**
     * Get an URI for backend edit
     *
     * @return string
     */
    public function render(): string
    {
        return BackendUtility::getBackendEditUri($this->arguments['tableName'], $this->arguments['identifier'], $this->arguments['addReturnUrl']);
    }
}
