<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\Helper\Models;

use Modules\Media\Models\Collection;
use Modules\Media\Models\Media;
use Modules\Helper\Models\HelperStatus;
use Modules\Helper\Models\Template;
use Modules\Helper\Models\TemplateDataType;
use Modules\Helper\Models\TemplateMapper;

class TemplateMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $template = new Template();

        $template->setCreatedBy(1);
        $template->setName('Title');
        $template->setStatus(HelperStatus::ACTIVE);
        $template->setDescription('Description');
        $template->setDescriptionRaw('DescriptionRaw');
        $template->setDatatype(TemplateDataType::OTHER);
        $template->setStandalone(false);
        $template->setExpected(['source1.csv', 'source2.csv']);

        $collection = new Collection();
        $collection->setCreatedBy(1);

        $templateFiles = [
            [
                'extension' => 'php',
                'filename' => 'EventCourse.lang.php',
                'name' => 'EventCourse',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'php',
                'filename' => 'EventCourse.pdf.php',
                'name' => 'EventCourse',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'php',
                'filename' => 'EventCourse.tpl.php',
                'name' => 'EventCourse',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'php',
                'filename' => 'EventCourse.xlsx.php',
                'name' => 'EventCourse',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'php',
                'filename' => 'Worker.php',
                'name' => 'Worker',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ]
        ];

        foreach ($templateFiles as $file) {
            $media = new Media();
            $media->setCreatedBy(1);
            $media->setExtension($file['extension']);
            $media->setPath(\trim($file['path'], '/') . '/' . $file['filename']);
            $media->setName($file['name']);
            $media->setSize($file['size']);

            $collection->addSource($media);
        }

        $template->setSource($collection);

        $id = TemplateMapper::create($template);
        self::assertGreaterThan(0, $template->getId());
        self::assertEquals($id, $template->getId());

        $templateR = TemplateMapper::get($template->getId());
        self::assertEquals($template->getCreatedAt()->format('Y-m-d'), $templateR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($template->getCreatedBy(), $templateR->getCreatedBy()->getId());
        self::assertEquals($template->getDescription(), $templateR->getDescription());
        self::assertEquals($template->getDescriptionRaw(), $templateR->getDescriptionRaw());
        self::assertEquals($template->getName(), $templateR->getName());
        self::assertEquals($template->getStatus(), $templateR->getStatus());
        self::assertEquals($template->isStandalone(), $templateR->isStandalone());
        self::assertEquals($template->getDatatype(), $templateR->getDatatype());
        self::assertEquals($template->getExpected(), $templateR->getExpected());
    }

    public function testNewest() : void
    {
        $newest = TemplateMapper::getNewest(1);

        self::assertEquals(1, \count($newest));
    }
}