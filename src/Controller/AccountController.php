<?php
/**
 * This code is open source and licensed under the MIT License
 * Author: Benjamin Leveque <info@connectx.fr>
 * Copyright (c) - connectX
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace App\Controller;

use App\Service\AccountMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private $accountMailer;

    /**
     * AccountController constructor.
     * @param AccountMailer $accountMailer
     */
    public function __construct(AccountMailer $accountMailer)
    {
        $this->accountMailer = $accountMailer;
    }

    /**
     * @Route("/account/requestResetPassword", name="requestResetPassword", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function requestResetPassword(Request $request)
    {
        return $this->accountMailer->requestResetPassword($request);
    }

//    /**
//     * @Route("/account/goResetPassword/{token}", name="goResetPassword", methods={"POST"})
//     * @param Request $request
//     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function goResetPassword(Request $request)
//    {
//        $host = $request->server->get('FRONT_HOST');
//        if (is_null($host)) {
//            return Utils::generateJsonResponse(false, 'INVALID_HOST', 400);
//        }
//        $token = $request->get('token');
//        if (is_null($token)) {
//            return Utils::generateJsonResponse(false, 'INVALID_TOKEN', 400);
//        }
//        $url = sprintf('%s://%s/account/reset-password/%s', 'https', $host, $token);
//        $statusCode = ($request->server->get('APP_ENV') == 'prod' ? 301 : 302);
//        return $this->redirect($url, $statusCode);
//    }

    /**
     * @Route("/account/resetPassword/{token}", name="resetPassword", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        return $this->accountMailer->resetPassword($request);
    }

    /**
     * @Route("/account/requestConfirmEmail", name="requestConfirmEmail", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function requestConfirmEmail(Request $request)
    {
        return $this->accountMailer->requestConfirmEmail($request);
    }

//    /**
//     * @Route("/account/goConfirmEmail/{token}", name="goConfirmEmail", methods={"POST"})
//     * @param Request $request
//     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function goConfirmEmail(Request $request)
//    {
//        $host = $request->server->get('FRONT_HOST');
//        if (is_null($host)) {
//            return Utils::generateJsonResponse(false, 'INVALID_HOST', 400);
//        }
//        $token = $request->get('token');
//        if (is_null($token)) {
//            return Utils::generateJsonResponse(false, 'INVALID_TOKEN', 400);
//        }
//        $url = sprintf('%s://%s/account/confirm/%s', 'https', $host, $token);
//        $statusCode = ($request->server->get('APP_ENV') == 'prod' ? 301 : 302);
//        return $this->redirect($url, $statusCode);
//    }

    /**
     * @Route("/account/confirmEmail/{token}", name="confirmEmail", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function confirmEmail(Request $request)
    {
        return $this->accountMailer->confirmEmail($request);
    }
}
