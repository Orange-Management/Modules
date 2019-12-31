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
 * @package Modules\Profile
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#138
 *  Allow Admin to login as user
 *  Admins should be allowed to log in as users.
 *  This doesn't mean that the admins can create content in the name of a user but they get to see all the things this user can see.
 *  They basically log in with the same permissions.
 */
final class ApiController extends Controller
{
    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiProfileCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $profiles = $this->createProfilesFromRequest($request);
        $created  = [];
        $status   = true;

        foreach ($profiles as $profile) {
            $status = $status && $this->apiProfileCreateDbEntry($profile, $request);

            $created[] = $profile;
        }

        $this->fillJsonResponse(
            $request, $response,
            $status ? NotificationLevel::OK : NotificationLevel::WARNING,
            'Profil',
            $status ? 'Profil successfully created.' : 'Profile already existing.',
            $created
        );
    }

    /**
     * @param Profile         $profile Profile to create in the database
     * @param RequestAbstract $request Request
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function apiProfileCreateDbEntry(Profile $profile, RequestAbstract $request) : bool
    {
        if ($profile->getId() !== 0) {
            return false;
        }

        $this->createModel($request->getHeader()->getAccount(), $profile, ProfileMapper::class, 'profile');

        return true;
    }

    /**
     * Method to create profile from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return array<Profile>
     *
     * @since 1.0.0
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
