<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\tests\Kanban\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Kanban\Models\CardStatus;
use Modules\Kanban\Models\CardType;
use Modules\Kanban\Models\KanbanCard;
use Modules\Kanban\Models\KanbanCardMapper;
use phpOMS\Utils\RnG\Text;

/**
 * @internal
 */
class KanbanCardMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $card = new KanbanCard();

        $card->setName('Some Card name');
        $card->setDescription('This is some card description');
        $card->setStatus(CardStatus::ACTIVE);
        $card->setType(CardType::TEXT);
        $card->setOrder(1);
        $card->setColumn(1);
        $card->setCreatedBy(new NullAccount(1));
        $card->addLabel(1);
        $card->addLabel(2);

        $id = KanbanCardMapper::create($card);
        self::assertGreaterThan(0, $card->getId());
        self::assertEquals($id, $card->getId());

        $cardR = KanbanCardMapper::get($card->getId());
        self::assertEquals($card->getName(), $cardR->getName());
        self::assertEquals($card->getDescription(), $cardR->getDescription());
        self::assertEquals($card->getColumn(), $cardR->getColumn());
        self::assertEquals($card->getOrder(), $cardR->getOrder());
        self::assertEquals($card->getStatus(), $cardR->getStatus());
        self::assertEquals($card->getType(), $cardR->getType());
        self::assertEquals($card->getCreatedBy()->getId(), $cardR->getCreatedBy()->getId());
        self::assertEquals($card->getCreatedAt()->format('Y-m-d'), $cardR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($card->getRef(), $cardR->getRef());
    }

    public function testTaskCard() : void
    {
        $card = new KanbanCard();

        $card->setStatus(CardStatus::ACTIVE);
        $card->setType(CardType::TASK);
        $card->setRef(1);
        $card->setOrder(1);
        $card->setColumn(1);
        $card->setCreatedBy(new NullAccount(1));
        $card->addLabel(1);
        $card->addLabel(2);

        $id = KanbanCardMapper::create($card);
        self::assertGreaterThan(0, $card->getId());
        self::assertEquals($id, $card->getId());
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 10; ++$i) {
            $text = new Text();
            $card = new KanbanCard();

            $card->setName($text->generateText(\mt_rand(3, 7)));
            $card->setDescription($text->generateText(\mt_rand(20, 100)));
            $card->setStatus(CardStatus::ACTIVE);
            $card->setType(CardType::TEXT);
            $card->setOrder(\mt_rand(1, 10));
            $card->setColumn(\mt_rand(1, 4));
            $card->setCreatedBy(new NullAccount(1));
            $card->addLabel(2);
            $card->addLabel(3);

            $id = KanbanCardMapper::create($card);
        }
    }
}
