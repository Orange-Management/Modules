<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Profile
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Profile\Theme\Backend\Components\AccountGroupSelector;

use phpOMS\Localization\L11nManager;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Component view.
 *
 * @package Modules\Profile
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 * @codeCoverageIgnore
 */
class BaseView extends View
{
    /**
     * Dom id
     *
     * @var string
     * @since 1.0.0
     */
    private string $id = '';

    /**
     * Is required?
     *
     * @var bool
     * @since 1.0.0
     */
    private bool $isRequired = false;

    /**
     * Dom name
     *
     * @var string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * {@inheritdoc}
     */
    public function __construct(L11nManager $l11n = null, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($l11n, $request, $response);
        $this->setTemplate('/Modules/Profile/Theme/Backend/Components/AccountGroupSelector/base');

        $view = new PopupView($l11n, $request, $response);
        $this->addData('popup', $view);
    }

    /**
     * Get selector id
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Is required?
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function isRequired() : bool
    {
        return $this->isRequired;
    }

    /**
     * {@inheritdoc}
     */
    public function render(...$data) : string
    {
        $this->id         = $data[0];
        $this->name       = $data[1];
        $this->isRequired = $data[2] ?? false;
        $this->getData('popup')->setId($this->id);
        return parent::render();
    }
}
