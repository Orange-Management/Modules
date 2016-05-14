<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Media\Models;


/**
 * Upload.
 *
 * @category   Modules
 * @package    Modules\Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class UploadFile
{

    /**
     * Upload max size.
     *
     * @var int
     * @since 1.0.0
     */
    private $maxSize = 50000000;

    /**
     * Allowed mime types.
     *
     * @var array
     * @since 1.0.0
     */
    private $allowedTypes = [];

    /**
     * Output directory.
     *
     * @var string
     * @since 1.0.0
     */
    private $outputDir = '/Modules/Media/Files';

    /**
     * Output file name.
     *
     * @var string
     * @since 1.0.0
     */
    private $fileName = '';

    /**
     * Output file name.
     *
     * @var bool
     * @since 1.0.0
     */
    private $preserveFileName = true;

    /**
     * Upload file to server.
     *
     * @param array $files File data ($_FILE)
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function upload(array $files) : array
    {
        $result = [];

        if (count($files) == count($files, COUNT_RECURSIVE)) {
            $files = [$files];
        }

        $this->findOutputDir($files);
        $rpath = $this->outputDir;

        foreach ($files as $key => $f) {
            $result[$key]           = [];
            $result[$key]['status'] = UploadStatus::OK;

            if (!isset($f['error'])) {
                // TODO: handle wrong parameters
                $result[$key]['status'] = UploadStatus::WRONG_PARAMETERS;

                return $result;
            } elseif ($f['error'] !== UPLOAD_ERR_OK) {
                $result[$key]['status'] = $this->getUploadError($f['error']);

                return $result;
            }

            $result[$key]['size'] = $f['size'];

            if ($f['size'] > $this->maxSize) {
                // too large2
                $result[$key]['status'] = UploadStatus::CONFIG_SIZE;

                return $result;
            }

            // TODO: do I need pecl fileinfo?
            if (!empty($this->allowedTypes) && false === $ext = array_search($f['type'], $this->allowedTypes, true)) {
                // wrong file format
                $result[$key]['status'] = UploadStatus::WRONG_EXTENSION;

                return $result;
            }

            $path = __DIR__ . '/../../..' . $this->outputDir;

            if ($this->preserveFileName) {
                $this->fileName = $f['name'];
            }

            $split                     = explode('.', $f['name']);
            $extension                 = count($split) > 1 ? $split[count($split) - 1] : '';
            $result[$key]['extension'] = $extension;

            if (!$this->fileName || empty($this->fileName) || file_exists($path . '/' . $this->fileName)) {
                $rnd = '';

                do {
                    $sha = sha1_file($f['tmp_name'] . $rnd);
                    $sha .= '.' . $extension;

                    if ($sha === false) {
                        $result[$key]['status'] = UploadStatus::FAILED_HASHING;

                        return $result;
                    }

                    $this->fileName = $sha;
                    $rnd            = rand();
                } while (file_exists($path . '/' . $this->fileName));
            }

            $result[$key]['filename'] = $this->fileName;

            if (!is_dir($path)) {
                \mkdir($path, '0655', true);
            }

            if (!is_uploaded_file($f['tmp_name'])) {
                $result[$key]['status'] = UploadStatus::NOT_UPLOADED;

                return $result;
            }

            if (!move_uploaded_file($f['tmp_name'], $path . '/' . $this->fileName)) {
                $result[$key]['status'] = UploadStatus::NOT_MOVABLE;

                return $result;
            }

            $result[$key]['path'] = $rpath;
        }

        return $result;
    }

    /**
     * Find unique output path for batch of files
     *
     * @param array $files Array of files
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function findOutputDir(array $files)
    {
        if (count($files) > 1) {
            do {
                $rndPath = str_pad(dechex(rand(0, 65535)), 4, '0', STR_PAD_LEFT);
            } while (file_exists($this->outputDir . '/' . $rndPath));

            $this->outputDir = $this->outputDir . '/' . $rndPath;
        }
    }

    /**
     * Get upload error
     *
     * @param mixed $error Error type
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function getUploadError($error) : int
    {
        switch ($error) {
            case UPLOAD_ERR_NO_FILE:
                // TODO: no file sent
                return UploadStatus::NOTHING_UPLOADED;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return UploadStatus::UPLOAD_SIZE;
            default:
                return UploadStatus::UNKNOWN_ERROR;
        }
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMaxSize() : int
    {
        return $this->maxSize;
    }

    /**
     * @param int $maxSize
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setMaxSize(int $maxSize)
    {
        $this->maxSize = $maxSize;
    }

    /**
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAllowedTypes() : array
    {
        return $this->allowedTypes;
    }

    /**
     * @param array $allowedTypes
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAllowedTypes(array $allowedTypes)
    {
        $this->allowedTypes = $allowedTypes;
    }

    /**
     * @param array $allowedTypes
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addAllowedTypes($allowedTypes)
    {
        $this->allowedTypes[] = $allowedTypes;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOutputDir() : string
    {
        return $this->outputDir;
    }

    /**
     * @param string $outputDir
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setOutputDir(string $outputDir)
    {
        $this->outputDir = $outputDir;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFileName() : string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param bool $preserveFileName
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPreserveFileName(bool $preserveFileName)
    {
        $this->preserveFileName = $preserveFileName;
    }
}
