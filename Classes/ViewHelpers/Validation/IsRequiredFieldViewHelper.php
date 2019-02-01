<?php
declare(strict_types=1);
namespace In2code\Femanager\ViewHelpers\Validation;

use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * Class IsRequiredFieldViewHelper
 */
class IsRequiredFieldViewHelper extends AbstractValidationViewHelper
{

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject
     */
    protected $configurationManager;


    /**
     * Initialize
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('fieldName', 'string', '', true);
    }


    /**
     * Check if this field is a required field
     *
     * @return bool
     */
    public function render()
    {
        $settings = $this->getSettingsConfiguration();
        return !empty($settings[$this->getControllerName()][$this->getValidationName()][$this->arguments['fieldName']]['required']);
    }

    /**
     * @return array
     */
    protected function getSettingsConfiguration()
    {
        return (array)$this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'Femanager',
            'Pi1'
        );
    }
}
