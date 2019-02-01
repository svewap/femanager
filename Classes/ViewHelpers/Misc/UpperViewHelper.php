<?php
declare(strict_types=1);
namespace In2code\Femanager\ViewHelpers\Misc;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class UpperViewHelper
 */
class UpperViewHelper extends AbstractViewHelper
{

    /**
     * Initialize
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('string', 'string', '', true, '');
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return ucfirst($this->arguments['string']);
    }
}
