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

use Modules\Messages\Email;

/**
 * IMAP class.
 *
 * @category   Modules
 * @package    Messages
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class IMAP implements Email
{
    private $con = null;

    public function __construct()
    {
    }

    public function connect($host, $port, $user, $password)
    {
        $this->con = imap_open('{' . $host . ':' . $port . '}', $user, $password);
    }

    public function getListNew()
    {
        // TODO: Implement getListNew() method.
    }

    public function getListAll()
    {
        // TODO: Implement getListAll() method.
    }

    public function getMessage()
    {
        // TODO: Implement getMessage() method.
    }

    public function removeMessage()
    {
        // TODO: Implement removeMessage() method.
    }

    public function setStatus()
    {
        // TODO: Implement setStatus() method.
    }
}
