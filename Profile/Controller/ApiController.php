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

namespace Modules\Profile\Controller;

use Modules\Admin\Models\AccountMapper;
use Modules\Profile\Models\Profile;
use Modules\Profile\Models\ProfileMapper;

use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Profile class.
 *
 * @package    Modules\Profile
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class ApiController extends Controller
{
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
            $this->apiProfileCreateDbEntry($profile);

            $created[] = $profile->jsonSerialize();
        }

        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
            'title' => 'Profile(s)',
            'message' => 'Profile(s) successfully created.',
            'response' => $created
        ]);
    }

    /**
     * @param Profile $profile Profile to create in the database
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiProfileCreateDbEntry(Profile $profile) : void
    {
        $this->app->eventManager->trigger('PRE:Module:Admin-profile-create', '', $profile);
        ProfileMapper::create($profile);
        $this->app->eventManager->trigger('POST:Module:Admin-profile-create', '', [
            $profile->getAccount()->getId(),
            null,
            $profile,
        ]);
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
        $accounts = $request->getDataList('iaccount-idlist');

        foreach ($accounts as $account) {
            $account = (int) \trim($account);
            $isInDb  = ProfileMapper::getFor($account, 'account');

            if ($isInDb->getId() !== 0) {
                $profiles[] = $isInDb;
                continue;
            }

            $profiles[] = new Profile(AccountMapper::get($account));
        }

        return $profiles;
    }
}
