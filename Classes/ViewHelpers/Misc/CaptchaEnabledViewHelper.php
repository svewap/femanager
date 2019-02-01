<?php
declare(strict_types=1);
namespace In2code\Femanager\ViewHelpers\Misc;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Look if captcha is enabled
 */
class CaptchaEnabledViewHelper extends AbstractViewHelper
{

    /**
     * Initialize
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('settings', 'array', 'TypoScript', true);
    }

    /**
     * Check if captcha is enabled
     *
     * @return bool
     */
    public function render(): bool
    {
        $controllerName = strtolower($this->controllerContext->getRequest()->getControllerName());
        return ExtensionManagementUtility::isLoaded('sr_freecap')
            && !empty($this->arguments['settings'][$controllerName]['validation']['captcha']['captcha']);
    }
}
