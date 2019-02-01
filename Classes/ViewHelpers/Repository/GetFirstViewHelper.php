<?php
declare(strict_types=1);
namespace In2code\Femanager\ViewHelpers\Repository;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class GetFirstViewHelper
 */
class GetFirstViewHelper extends AbstractViewHelper
{

    /**
     * Initialize the arguments.
     *
     * @return void
     * @api
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('objects', 'mixed', '', true);
    }

    /**
     * Call getFirst() method of object storage
     *
     * @return object|null
     */
    public function render()
    {
        $objects = $this->arguments['objects'];
        if (method_exists($objects, 'getFirst')) {
            return $objects->getFirst();
        }
        return null;
    }
}
