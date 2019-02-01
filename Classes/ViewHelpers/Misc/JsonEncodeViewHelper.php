<?php
declare(strict_types=1);
namespace In2code\Femanager\ViewHelpers\Misc;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class JsonEncodeViewHelper
 */
class JsonEncodeViewHelper extends AbstractViewHelper
{

    /**
     * @var null
     */
    protected $escapeOutput = false;


    /**
     * Initialize
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('array', 'array', '', true);
    }


    /**
     * @param array $array
     * @return string
     */
    public function render(): string
    {
        return json_encode($this->arguments['array']);
    }
}
