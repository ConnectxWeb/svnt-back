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

namespace App\Service;

use App\Entity\User;
use DateTime;
use Exception;
use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class AccountMailer
{
    private $mailer;
    private $tokenGenerator;
    private $userManager;
    /**
     * @var EngineInterface
     */
    private $templating;
    /**
     * @var Swift_Mailer
     */
    private $swiftMailer;
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * AccountMailer constructor.
     * @param MailerInterface $mailer
     * @param TokenGeneratorInterface $tokenGenerator
     * @param UserManagerInterface $userManager
     * @param EngineInterface $templating
     * @param Swift_Mailer $swiftMailer
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        MailerInterface $mailer,
        TokenGeneratorInterface $tokenGenerator,
        UserManagerInterface $userManager,
        EngineInterface $templating,
        Swift_Mailer $swiftMailer,
        UrlGeneratorInterface $router
    ) {
        $this->mailer = $mailer;
        $this->tokenGenerator = $tokenGenerator;
        $this->userManager = $userManager;
        $this->templating = $templating;
        $this->swiftMailer = $swiftMailer;
        $this->router = $router;
    }

    public function requestResetPassword(Request $request): JsonResponse
    {
        try {
            $json = json_decode($request->getContent(), true);
            if (is_null($json)) {
                return Utils::generateJsonResponse(false, 'JSON_DECODE_ERROR', 400);
            }
            $email = $json['email'];
            $user = $this->userManager->findUserByEmail($email);
            if (is_null($user)) {
                return Utils::generateJsonResponse(false, 'USER_NOT_FOUND', 400);
            }
            if (null === $user->getConfirmationToken() ||
                !$user->isPasswordRequestNonExpired($request->server->get('FOSUSER_TOKEN_PWD_TTL'))) {
                $user->setConfirmationToken($this->tokenGenerator->generateToken());
                $user->setPasswordRequestedAt(new DateTime());
                $this->userManager->updateUser($user);
            }
            $this->sendResetPassword($request,
                $user);
            return Utils::generateJsonResponse(true, 'REQUEST_PASSWORD_SUCCESS', 200);
        } catch (Exception $exception) {
            return Utils::generateJsonResponse(false, $exception->getMessage(), $exception->getCode());
        }
    }

    private function sendResetPassword(Request $request, User $user)
    {
        $url = sprintf('%s://%s/account/reset-password/%s',
            'https',
            $request->getHost(),
            $user->getConfirmationToken()
        ); //todo: check scheme in debug

        $message = (new Swift_Message('Réinitialisation de votre mot de passe'))
            ->setFrom($request->server->get('FOSUSER_FROM_EMAIL'))
            ->setTo($user->getEmail())
            ->setBody(
                $this->templating->render(
                    'emails/reset-password.txt.twig',
                    [
                        'user' => $user,
                        'confirmationUrl' => $url
                    ]
                ),
                'text/plain'
            );
        return $this->swiftMailer->send($message);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        try {
            $token = $request->get('token');
            if (is_null($token)) {
                return Utils::generateJsonResponse(false, 'TOKEN_EMPTY', 400);
            }
            $json = json_decode($request->getContent(), true);
            if (is_null($json)) {
                return Utils::generateJsonResponse(false, 'JSON_DECODE_ERROR', 400);
            }
            $password = $json['password'];
            if (is_null($password)) {
                return Utils::generateJsonResponse(false, 'PASSWORD_EMPTY', 400);
            }

            $user = $this->userManager->findUserByConfirmationToken($token);
            if (is_null($user)) {
                return Utils::generateJsonResponse(false, 'USER_NOT_FOUND', 400);
            }
            if (!$user->isPasswordRequestNonExpired($request->server->get('FOSUSER_TOKEN_PWD_TTL'))) {
                return Utils::generateJsonResponse(false, 'TOKEN_EXPIRED', 400);
            }
            $user->setPlainPassword($password);
            $this->userManager->updateUser($user);
            return Utils::generateJsonResponse(true, 'PASSWORD_UPDATE_SUCCESS', 200);
        } catch (Exception $exception) {
            return Utils::generateJsonResponse(false, $exception->getMessage(), $exception->getCode());
        }
    }

    public function requestConfirmEmail(Request $request): JsonResponse
    {
        try {
            $json = json_decode($request->getContent(), true);
            if (is_null($json)) {
                return Utils::generateJsonResponse(false, 'JSON_DECODE_ERROR', 400);
            }
            $email = $json['email'];
            $user = $this->userManager->findUserByEmail($email);
            if (is_null($user)) {
                return Utils::generateJsonResponse(false, 'USER_NOT_FOUND', 400);
            }
            if (null === $user->getConfirmationToken()) {
                $user->setConfirmationToken($this->tokenGenerator->generateToken());
                $this->userManager->updateUser($user);
            }
            $this->sendRegistrationConfirm($request, $user);
            return Utils::generateJsonResponse(true, 'REQUEST_CONFIRMATION_SUCCESS', 200);
        } catch (Exception $exception) {
            return Utils::generateJsonResponse(false, $exception->getMessage(), $exception->getCode());
        }
    }

    private function sendRegistrationConfirm(Request $request, User $user)
    {
        $url = sprintf('%s://%s/account/confirm/%s',
            'https',
            $request->getHost(),
            $user->getConfirmationToken()
        ); //todo: check scheme in debug

        $message = (new Swift_Message(sprintf('Bienvenue %s', $user->getFirstname())))
            ->setFrom($request->server->get('FOSUSER_FROM_EMAIL'))
            ->setTo($user->getEmail())
            ->setBody(
                $this->templating->render(
                    'emails/registration-confirm.txt.twig',
                    ['user' => $user, 'confirmationUrl' => $url]
                ),
                'text/plain'
            );
        return $this->swiftMailer->send($message);
    }

    public function confirmEmail(Request $request): JsonResponse
    {
        try {
            $token = $request->get('token');
            if (is_null($token)) {
                return Utils::generateJsonResponse(false, 'TOKEN_EMPTY', 400);
            }

            $user = $this->userManager->findUserByConfirmationToken($token);
            if (is_null($user)) {
                return Utils::generateJsonResponse(false, 'USER_NOT_FOUND', 400);
            }
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
            return Utils::generateJsonResponse(true, 'EMAIL_CONFIRM_SUCCESS', 200);
        } catch (Exception $exception) {
            return Utils::generateJsonResponse(false, $exception->getMessage(), $exception->getCode());
        }
    }

}