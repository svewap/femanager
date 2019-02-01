<?php
declare(strict_types=1);
namespace In2code\Femanager\ViewHelpers\Validation;

/**
 * Class FormValidationDataViewHelper
 */
class FormValidationDataViewHelper extends AbstractValidationViewHelper
{

    /**
     * Validation names with simple configuration
     *
     * @var array
     */
    protected $simpleValidations = [
		'date',
		'email',
		'intOnly',
		'lettersOnly',
		'required',
		'uniqueInDb',
		'uniqueInPage'
    ];


    /**
     * Initialize
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('settings', 'array', 'TypoScript', true);
        $this->registerArgument('fieldName', 'string', 'Fieldname', true);
        $this->registerArgument('additionalAttributes', 'array', 'AdditionalAttributes', false, []);
    }

    /**
     * Set javascript validation data for input fields
     *
     * @return array
     */
    public function render()
    {
        if ($this->arguments['settings'][$this->getControllerName()]['validation']['_enable']['client'] === '1') {
            $validationString = $this->getValidationString($this->arguments['settings'], $this->arguments['fieldName']);
            if (!empty($validationString)) {
                if (!empty($this->arguments['additionalAttributes']['data-validation'])) {
                    $this->arguments['additionalAttributes']['data-validation'] .= ',' . $validationString;
                } else {
                    $this->arguments['additionalAttributes']['data-validation'] = $validationString;
                }
            }
        }
        return $this->arguments['additionalAttributes'];
    }

    /**
     * Get validation string like
     *        required, email, min(10), max(10), intOnly,
     *        lettersOnly, uniqueInPage, uniqueInDb, date,
     *        mustInclude(number|letter|special), inList(1|2|3)
     *
     * @param array $settings Validation TypoScript
     * @param string $fieldName Fieldname
     * @return string
     */
    protected function getValidationString($settings, $fieldName)
    {
        $string = '';
        $validationSettings = (array)$settings[$this->getControllerName()][$this->getValidationName()][$fieldName];
        foreach ($validationSettings as $validation => $configuration) {
            if (!empty($string)) {
                $string .= ',';
            }
            $string .= $this->getSingleValidationString($validation, $configuration);
        }
        return $string;
    }

    /**
     * @param string $validation
     * @param string $configuration
     * @return string
     */
    protected function getSingleValidationString($validation, $configuration)
    {
        $string = '';
        if ($this->isSimpleValidation($validation) && $configuration === '1') {
            $string = $validation;
        }
        if (!$this->isSimpleValidation($validation)) {
            $string = $validation;
            $string .= '(' . str_replace(',', '|', $configuration) . ')';
        }
        return $string;
    }

    /**
     * Check if validation is simple or extended
     *
     * @param string $validation
     * @return bool
     */
    protected function isSimpleValidation($validation)
    {
        if (in_array($validation, $this->simpleValidations)) {
            return true;
        }
        return false;
    }
}
