<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Knowledgebase\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Admin;

use Modules\Knowledgebase\Models\WikiCategory;
use Modules\Knowledgebase\Models\WikiCategoryMapper;

use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;
use phpOMS\DataStorage\Database\DatabasePool;

/**
 * Installer class.
 *
 * @package Modules\Knowledgebase\Admin
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Installer extends InstallerAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function install(DatabasePool $dbPool, InfoManager $info) : void
    {
        parent::install($dbPool, $info);

        $category = new WikiCategory();
        $category->setName('Default');
        $category->setPath('/');

        WikiCategoryMapper::create($category);
    }
}
