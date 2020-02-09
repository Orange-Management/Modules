<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Media\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Media\Admin;

use Modules\Media\Models\Collection;

use Modules\Media\Models\CollectionMapper;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InstallerAbstract;
use phpOMS\System\File\PathException;

/**
 * Installer class.
 *
 * @package Modules\Media\Admin
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Installer extends InstallerAbstract
{
    /**
     * Install data from providing modules.
     *
     * @param DatabasePool $dbPool Database pool
     * @param array        $data   Module info
     *
     * @return void
     *
     * @throws PathException This exception is thrown if the Navigation install file couldn't be found
     * @throws \Exception    This exception is thrown if the Navigation install file is invalid json
     *
     * @since 1.0.0
     */
    public static function installExternal(DatabasePool $dbPool, array $data) : void
    {
         try {
            $dbPool->get()->con->query('select 1 from `' . $dbPool->get()->prefix . 'media`');
        } catch (\Exception $e) {
            return;
        }

        $mediaFile = \file_get_contents($data['path'] ?? '');

        if ($mediaFile === false) {
            throw new PathException($data['path'] ?? '');
        }

        $mediaData = \json_decode($mediaFile, true);

        if ($mediaData === false) {
            throw new \Exception();
        }

        foreach ($mediaData as $media) {
            self::installMedia($dbPool, $media);
        }
    }

    /**
     * Install media element.
     *
     * @param DatabasePool $dbPool Database instance
     * @param array        $data   Media info
     *
     * @return void
     *
     * @since 1.0.0
     */
    private static function installMedia($dbPool, $data) : void
    {
        $collection = new Collection();
        $collection->setName((string) $data['name'] ?? '');
        $collection->setVirtualPath((string) $data['virtualPath'] ?? '/');
        $collection->setPath((string) $data['virtualPath'] ?? '/');
        $collection->setCreatedBy((int) $data['user'] ?? 1);

        CollectionMapper::create($collection);
    }
}
