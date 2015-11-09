<?php
/*
 * This file is part of the Truckee\Match package.
 * 
 * (c) George W. Brooks
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//src\Truckee\MatchBundle\Controller\RegistrationController


namespace Truckee\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/register")
 */
class RegistrationController extends Controller
{
    /**
     * @Route("/staff", name="reg_staff")
     *
     * @return type
     */
    public function registerStaffAction(Request $request)
    {
        $templates = array();

        return $this->container
                ->get('pugx_multi_user.registration_manager')
                ->register('Truckee\MatchBundle\Entity\Staff', $templates);
    }

    /**
     * @Route("/volunteer", name="reg_volunteer")
     *
     * @return type
     */
    public function registerVolunteerAction()
    {
        $focusRequired = $this->getParameter('focus_required');
        $skillRequired = $this->getParameter('skill_required');
        $tools = $this->container->get('truckee_match.toolbox');

        $templates = $tools->getVolunteerTemplates($focusRequired, $skillRequired, 'register');

        return $this->container
                ->get('pugx_multi_user.registration_manager')
                ->register('Truckee\MatchBundle\Entity\Volunteer', $templates);
    }

    /**
     * @Route("/admin", name="reg_admin")
     *
     * @return type
     */
    public function registerAdminAction()
    {
        return $this->container
                ->get('pugx_multi_user.registration_manager')
                ->register('Truckee\MatchBundle\Entity\Admin');
    }
}