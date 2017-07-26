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
namespace Modules\Admin\Models;

use phpOMS\Utils\IO\Zip\Zip;
use Modules\Admin\Models\Exceptions\InvalidSignatureException;
use Modules\Admin\Models\Exceptions\InvalidVersionException;

class Package
{
    private $src = '';
    private $dest = '';
    
    public function __construct(string $src, string $dest)
    {
        $this->src = $src;
        $this->dest = $dest;
    }
    
    public function unpack() : bool
    {
        if(!Zip::unpack($this->src, $this->dest)) {
            return false;
        }
        
        return true;
    }

    public function validated() : bool
    {
        if(!$this->validateSignature()) {
            throw new InvalidSignatureException();
        }
        
        if(!$this->validateVersion()) {
            throw new InvalidVersionException();
        }
        
        return true;
    }

    private function validateSignature() : bool
    {
        return true;
    }

    private function validateVersion() : bool
    {
        return true;
    }
}
