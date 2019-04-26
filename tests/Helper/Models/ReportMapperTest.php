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
use Modules\Helper\Models\Report;
use Modules\Helper\Models\HelperStatus;
use Modules\Helper\Models\ReportMapper;
use Modules\Helper\Models\Template;
use Modules\Helper\Models\TemplateDataType;

class ReportMapperTest extends \PHPUnit\Framework\TestCase
{
    private function createTemplate()
    {
        $template = new Template();

        $template->setCreatedBy(1);
        $template->setName('Report Template');
        $template->setStatus(HelperStatus::ACTIVE);
        $template->setDescription('Description');
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
                'path' => '/Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'php',
                'filename' => 'EventCourse.pdf.php',
                'name' => 'EventCourse',
                'path' => '/Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'php',
                'filename' => 'EventCourse.tpl.php',
                'name' => 'EventCourse',
                'path' => '/Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'php',
                'filename' => 'EventCourse.xlsx.php',
                'name' => 'EventCourse',
                'path' => '/Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'php',
                'filename' => 'Worker.php',
                'name' => 'Worker',
                'path' => '/Demo/Modules/Helper/EventCourse',
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

        return $template;
    }

    public function testCRUD() : void
    {
        $report = new Report();

        $report->setCreatedBy(1);
        $report->setTitle('Title');
        $report->setStatus(HelperStatus::ACTIVE);
        $report->setDescription('Description');
        $report->setTemplate($this->createTemplate());

        $collection = new Collection();
        $collection->setCreatedBy(1);

        $reportFiles = [
            [
                'extension' => 'csv',
                'filename' => 'accounts.csv',
                'name' => 'accounts',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'csv',
                'filename' => 'costcenters.csv',
                'name' => 'costcenters',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'csv',
                'filename' => 'costobjects.csv',
                'name' => 'costobjects',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'csv',
                'filename' => 'crm.csv',
                'name' => 'crm',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
            [
                'extension' => 'csv',
                'filename' => 'entries.csv',
                'name' => 'entries',
                'path' => 'Demo/Modules/Helper/EventCourse',
                'size' => 1,
            ],
        ];

        foreach ($reportFiles as $file) {
            $media = new Media();
            $media->setCreatedBy(1);
            $media->setExtension($file['extension']);
            $media->setPath(\trim($file['path'], '/') . '/' . $file['filename']);
            $media->setName($file['name']);
            $media->setSize($file['size']);

            $collection->addSource($media);
        }

        $report->setSource($collection);

        $id = ReportMapper::create($report);
        self::assertGreaterThan(0, $report->getId());
        self::assertEquals($id, $report->getId());

        $reportR = ReportMapper::get($report->getId());
        self::assertEquals($report->getCreatedAt()->format('Y-m-d'), $reportR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($report->getCreatedBy(), $reportR->getCreatedBy()->getId());
        self::assertEquals($report->getDescription(), $reportR->getDescription());
        self::assertEquals($report->getTitle(), $reportR->getTitle());
        self::assertEquals($report->getStatus(), $reportR->getStatus());
        self::assertEquals($report->getTemplate()->getName(), $reportR->getTemplate()->getName());

    }
}
