<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Profile
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Profile;

use Modules\Profile\Models\Profile;
use Modules\Profile\Models\ProfileMapper;
use Modules\Profile\Models\PermissionState;
use Modules\Admin\Models\AccountMapper;

use phpOMS\Account\PermissionType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Asset\AssetType;

/**
 * Profile class.
 *
 * @package    Modules\Profile
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_NAME = 'Profile';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1000300000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setupProfileStyles(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        /** @var Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Profile/Theme/Backend/css/styles.css');
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewProfileList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Profile/Theme/Backend/profile-list');

        $view->setData('accounts', ProfileMapper::getNewest(25));

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewProfileSingle(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        /** @var Head $head */
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css');

        $view->setTemplate('/Modules/Profile/Theme/Backend/profile-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000301001, $request, $response));

        $mediaListView = new \Modules\Media\Theme\Backend\Components\Media\BaseView($this->app, $request, $response);
        $mediaListView->setTemplate('/Modules/Media/Theme/Backend/Components/Media/list');
        $view->addData('medialist', $mediaListView);

        $calendarView = new \Modules\Calendar\Theme\Backend\Components\Calendar\BaseView($this->app, $request, $response);
        $calendarView->setTemplate('/Modules/Calendar/Theme/Backend/Components/Calendar/mini');
        $view->addData('calendar', $calendarView);

        $view->setData('account', ProfileMapper::getFor((int) $request->getData('id'), 'account'));

        $accGrpSelector = new \Modules\Profile\Theme\Backend\Components\AccountGroupSelector\BaseView($this->app, $request, $response);
        $view->addData('accGrpSelector', $accGrpSelector);

        $settings = $this->app->appSettings->get([
            1000000001, 1000000002, 1000000003, 1000000004, 1000000005, 1000000006, 1000000007, 1000000008, 1000000009,
            1000000010, 1000000011, 1000000012, 1000000013, 1000000014, 1000000015, 1000000016, 1000000017, 1000000018, 1000000019,
            1000000020, 1000000021, 1000000022, 1000000023, 1000000024, 1000000025, 1000000026, 1000000027, 1000000028, 1000000029,
            1000001001, 1000001002, 1000001003, 1000001004, 1000001005,
            1000002001, 1000002002, 1000002003, 1000002004, 1000002005, 1000002006,
            1000003001, 1000003002, 1000003003, 1000003004, 1000003005, 1000003006,
            1000004001, 1000004002, 1000004003, 1000004004, 1000004005,
            1000005001, 1000005002, 1000005003, 1000005004, 1000005005, 1000005006, 1000005007, 1000005008,
        ]);
        $view->setData('settings', $settings);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewProfileAdminSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Profile/Theme/Backend/modules-settings');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000300000, $request, $response));

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewProfileAdminCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Profile/Theme/Backend/modules-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000300000, $request, $response));

        $accGrpSelector = new \Modules\Profile\Theme\Backend\Components\AccountGroupSelector\BaseView($this->app, $request, $response);
        $view->addData('accGrpSelector', $accGrpSelector);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiProfileCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $profiles = $this->createProfilesFromRequest($request);
        $created  = [];

        foreach ($profiles as $profile) {
            ProfileMapper::create($profile);
            $created[] = $profile->jsonSerialize();
        }

        $response->set($request->getUri()->__toString(), $created);
    }

    /**
     * Method to create profile from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return array<Profile>
     *
     * @since  1.0.0
     */
    private function createProfilesFromRequest(RequestAbstract $request) : array
    {
        $profiles = [];
        $accounts = \json_decode($request->getData('iaccount-idlist') ?? '[]', true);

        if ($accounts === false) {
            return $profiles;
        }

        if (\is_int($accounts)) {
            $accounts = [$accounts];
        }
        
        foreach ($accounts as $account) {
            $account = AccountMapper::get((int) $account);
            $profiles[] = new Profile(AccountMapper::get((int) $account));
        }

        return $profiles;
    }
}
