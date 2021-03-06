<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Media\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Media\Models;

use phpOMS\System\File\FileUtils;
use phpOMS\System\File\Local\Directory;

/**
 * Upload.
 *
 * @package Modules\Media\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 * @codeCoverageIgnore
 */
class UploadFile
{
    /**
     * Limit of iterations to find a possible random path for the file to upload to.
     *
     * @var int
     * @since 1.0.0
     */
    private const PATH_GENERATION_LIMIT = 1000;

    /**
     * Image interlaced.
     *
     * @var bool
     * @since 1.0.0
     */
    private bool $isInterlaced = true;

    /**
     * Upload max size.
     *
     * @var int
     * @since 1.0.0
     */
    private int $maxSize = 50000000;

    /**
     * Allowed mime types.
     *
     * @var string[]
     * @since 1.0.0
     */
    private $allowedTypes = [];

    /**
     * Output directory.
     *
     * @var string
     * @since 1.0.0
     */
    private string $outputDir = __DIR__ . '/../../Modules/Media/Files';

    /**
     * Output file name.
     *
     * @var string
     * @since 1.0.0
     */
    private string $fileName = '';

    /**
     * Output file name.
     *
     * @var bool
     * @since 1.0.0
     */
    private bool $preserveFileName = true;

    /**
     * Upload file to server.
     *
     * @param array  $files         File data ($_FILE)
     * @param string $name          File name
     * @param bool   $absolute      Use absolute path
     * @param string $encryptionKey Encryption key
     * @param string $encoding      Encoding used for uploaded file. Empty string will not convert file content.
     *
     * @return array
     *
     * @throws \Exception
     *
     * @since 1.0.0
     */
    public function upload(
        array $files,
        string $name = '',
        bool $absolute = false,
        string $encryptionKey = '',
        string $encoding = 'UTF-8'
    ) : array  {
        $result = [];

        if (\count($files) === \count($files, \COUNT_RECURSIVE)) {
            $files = [$files];
        }

        if (!$absolute && \count($files) > 1) {
            $this->outputDir = $this->findOutputDir();
        }

        $path = $this->outputDir;

        foreach ($files as $key => $f) {
            $result[$key]           = [];
            $result[$key]['status'] = UploadStatus::OK;

            if (!isset($f['error'])) {
                $result[$key]['status'] = UploadStatus::WRONG_PARAMETERS;

                return $result;
            } elseif ($f['error'] !== \UPLOAD_ERR_OK) {
                $result[$key]['status'] = $this->getUploadError($f['error']);

                return $result;
            }

            $result[$key]['size'] = $f['size'];

            if ($f['size'] > $this->maxSize) {
                $result[$key]['status'] = UploadStatus::CONFIG_SIZE;

                return $result;
            }

            if (!empty($this->allowedTypes) && ($ext = \array_search($f['type'], $this->allowedTypes, true)) === false) {
                $result[$key]['status'] = UploadStatus::WRONG_EXTENSION;

                return $result;
            }

            $split                     = \explode('.', $f['name']);
            $result[$key]['name']      = \count($files) === 1 && !empty($name) ? $name : $split[0];
            $extension                 = \count($split) > 1 ? $split[\count($split) - 1] : '';
            $result[$key]['extension'] = $extension;

            if ($this->preserveFileName) {
                $this->fileName           = $f['name'];
                $result[$key]['filename'] = $this->fileName;
            }

            if (empty($this->fileName) || \file_exists($path . '/' . $this->fileName)) {
                try {
                    $this->fileName           = $this->createFileName($path, $f['tmp_name'], $extension);
                    $result[$key]['filename'] = $this->fileName;
                } catch (\Exception $e) {
                    $result[$key]['filename'] = $f['name'];
                    $result[$key]['status']   = UploadStatus::FAILED_HASHING;

                    return $result;
                }
            }

            if (!\is_dir($path)) {
                Directory::create($path, 0755, true);
            }

            if (!\rename($f['tmp_name'], $dest = $path . '/' . $this->fileName)) {
                $result[$key]['status'] = UploadStatus::NOT_MOVABLE;

                return $result;
            }

            if ($encryptionKey !== '') {
                $nonce = \sodium_randombytes_buf(24);

                $fpSource  = \fopen($dest, 'r+');
                $fpEncoded = \fopen($dest . '.tmp', 'w');

                if ($fpSource === false || $fpEncoded === false) {
                    $result[$key]['status'] = UploadStatus::NOT_ENCRYPTABLE;

                    return $result;
                }

                while (($buffer = \fgets($fpSource, 4096)) !== false) {
                    $encrypted = \sodium_crypto_secretbox($buffer, $nonce, $encryptionKey);

                    \fwrite($fpEncoded, $encrypted);
                }

                \fclose($fpSource);
                \fclose($fpEncoded);

                \unlink($dest);
                \rename($dest . '.tmp', $dest);
                $result[$key]['nonce'] = $nonce;
            }

            /**
             * @todo Orange-Management/Modules#203
             *  Automatically enable image interlacing
             *  Interlacing png images currently messes up the images.
             */
            /*
            if ($this->isInterlaced && \in_array($extension, FileUtils::IMAGE_EXTENSION)) {
                //$this->interlace($extension, $dest);
            }
            */

            /**
             * @todo Orange-Management/Modules#204
             *  Automatically change the file encoding of text files
             *  Basic text files should be converted to utf-8. E.g.
             *  * csv
             *  * log
             *  * txt
             *  * ...
             */
            /*
            if ($encoding !== '') {
                // changing encoding bugs out image files
                //FileUtils::changeFileEncoding($dest, $encoding);
            }*/

            $result[$key]['path'] = \realpath($this->outputDir);
        }

        return $result;
    }

    /**
     * Create file name if file already exists or if file name should be random.
     *
     * @param string $path      Path where file should be saved
     * @param string $tempName  Temp. file name generated during upload
     * @param string $extension Extension name
     *
     * @return string
     *
     * @throws \Exception This exception is thrown if the file couldn't be created
     *
     * @since 1.0.0
     */
    private function createFileName(string $path, string $tempName, string $extension) : string
    {
        $rnd   = '';
        $limit = 0;

        do {
            $sha = \sha1_file($tempName . $rnd);

            if ($sha === false) {
                throw new \Exception('No file path could be found. Potential attack!');
            }

            $sha     .= '.' . $extension;
            $fileName = $sha;
            $rnd      = \mt_rand();
            ++$limit;
        } while (\file_exists($path . '/' . $fileName) && $limit < self::PATH_GENERATION_LIMIT);

        if ($limit >= self::PATH_GENERATION_LIMIT) {
            throw new \Exception('No file path could be found. Potential attack!');
        }

        return $fileName;
    }

    /**
     * Make image interlace
     *
     * @param string $extension Image extension
     * @param string $path      File path
     *
     * @return void
     *
     * @since 1.0.0
     */
    private function interlace(string $extension, string $path) : void
    {
        if ($extension === 'png') {
            $img = \imagecreatefrompng($path);
        } elseif ($extension === 'jpg' || $extension === 'jpeg') {
            $img = \imagecreatefromjpeg($path);
        } else {
            $img = \imagecreatefromgif($path);
        }

        if ($img === false) {
            return;
        }

        \imageinterlace($img, $this->isInterlaced ? 1 : 0);

        if ($extension === 'png') {
            \imagepng($img, $path);
        } elseif ($extension === 'jpg' || $extension === 'jpeg') {
            \imagejpeg($img, $path);
        } else {
            \imagegif($img, $path);
        }

        \imagedestroy($img);
    }

    /**
     * Find unique output path for batch of files
     *
     * @return string
     *
     * @since 1.0.0
     */
    private function findOutputDir() : string
    {
        do {
            $rndPath = \str_pad(\dechex(\mt_rand(0, 65535)), 4, '0', \STR_PAD_LEFT);
        } while (\file_exists($this->outputDir . '/' . $rndPath));

        return $this->outputDir . '/' . $rndPath;
    }

    /**
     * Get upload error
     *
     * @param mixed $error Error type
     *
     * @return int
     *
     * @since 1.0.0
     */
    private function getUploadError($error) : int
    {
        switch ($error) {
            case \UPLOAD_ERR_NO_FILE:
                return UploadStatus::NOTHING_UPLOADED;
            case \UPLOAD_ERR_INI_SIZE:
            case \UPLOAD_ERR_FORM_SIZE:
                return UploadStatus::UPLOAD_SIZE;
            default:
                return UploadStatus::UNKNOWN_ERROR;
        }
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getMaxSize() : int
    {
        return $this->maxSize;
    }

    /**
     * @param bool $isInterlaced Is interlaced
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setInterlaced(bool $isInterlaced) : void
    {
        $this->isInterlaced = $isInterlaced;
    }

    /**
     * @param int $maxSize Max allowed file size
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setMaxSize(int $maxSize) : void
    {
        $this->maxSize = $maxSize;
    }

    /**
     * @return string[]
     *
     * @since 1.0.0
     */
    public function getAllowedTypes() : array
    {
        return $this->allowedTypes;
    }

    /**
     * @param string[] $allowedTypes Allowed file types
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setAllowedTypes(array $allowedTypes) : void
    {
        $this->allowedTypes = $allowedTypes;
    }

    /**
     * @param string $allowedTypes Allowed file types
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addAllowedTypes(string $allowedTypes) : void
    {
        $this->allowedTypes[] = $allowedTypes;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getOutputDir() : string
    {
        return $this->outputDir;
    }

    /**
     * Define output directory of the upload
     *
     * @param string $outputDir Output directory of the uploaded file
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setOutputDir(string $outputDir) : void
    {
        $this->outputDir = $outputDir;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getFileName() : string
    {
        return $this->fileName;
    }

    /**
     * Set the file name of the uploaded file
     *
     * @param string $fileName File name of the uploaded file
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setFileName(string $fileName) : void
    {
        $this->fileName = $fileName;
    }

    /**
     * Define if the uploaded file name should be the same file name as the original file
     *
     * @param bool $preserveFileName Keep file name of the original file
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setPreserveFileName(bool $preserveFileName) : void
    {
        $this->preserveFileName = $preserveFileName;
    }
}
