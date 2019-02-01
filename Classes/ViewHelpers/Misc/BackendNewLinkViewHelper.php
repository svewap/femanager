<?php
declare(strict_types=1);
namespace In2code\Femanager\ViewHelpers\Misc;

use In2code\Femanager\Utility\BackendUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class BackendNewLinkViewHelper
 */
class BackendNewLinkViewHelper extends AbstractViewHelper
{

    /**
     * Initialize
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('tableName', 'string', '', true);
        $this->registerArgument('addReturnUrl', 'boolean', '', true, true);
    }

    /**
     * Get an URI for new records in backend
     *
     * @return string
     */
    public function render(): string
    {
        return BackendUtility::getBackendNewUri($this->arguments['tableName'], BackendUtility::getPageIdentifier(), $this->arguments['addReturnUrl']);
    }
}
