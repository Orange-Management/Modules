<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Messages;

/**
 * Email interface.
 *
 * @category   Modules
 * @package    Messages
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface Email
{
    public function connect($host, $port, $user, $password);

    public function getListNew();

    public function getListAll();

    public function getMessage();

    public function removeMessage();

    public function setStatus();
}
