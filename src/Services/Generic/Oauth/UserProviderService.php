<?php


namespace App\Services\Generic\Oauth;


use App\Entity\User;
use App\Services\Generic\Guzzle\GuzzleService;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface; //composer require hwi/oauth-bundle php-http/guzzle6-adapter php-http/httplug-bundle
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserProviderService extends BaseClass
{
//    /**
//     * {@inheritDoc}
//     */
//    public function connect(UserInterface $user, UserResponseInterface $response)
//    {
//        $property = $this->getProperty($response);
//        $username = $response->getUsername();
//
//        //on connect - get the access token and the user ID
//        $service = $response->getResourceOwner()->getName();
//
//        $setter = 'set'.ucfirst($service);
//        $setter_id = $setter.'Id';
//        $setter_token = $setter.'AccessToken';
//
//        //we "disconnect" previously connected users
//        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
//            $previousUser->$setter_id(null);
//            $previousUser->$setter_token(null);
//            $this->userManager->updateUser($previousUser);
//        }
//
//        //we connect current user
//        $user->$setter_id($username);
//        $user->$setter_token($response->getAccessToken());
//
//        $this->userManager->updateUser($user);
//    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();

        /** @var User $user */
        $user = $this->userManager->findUserByUsername($username);
        //when the user is registrating
        if (null === $user) {
            // create new user here
            $user = $this->userManager->createUser();

            $user->setUsername($username);
            $user->setPassword($username);//cannot be empty
            $user->setEnabled(true);
        }

        $this->updateExtra($user, $response);
        $this->userManager->updateUser($user);

        return $user;
    }

    private function updateExtra(User $user, UserResponseInterface $response)
    {
        $user->setEmail($response->getEmail());
        $user->setFullName($response->getRealName());
        $user->setFullName($response->getNickname());

        $profilePicture = $response->getProfilePicture();
        if ($profilePicture !== null) {
            $guzzle = new GuzzleService();
            $path = sprintf('cache/tmp/%s.jfif', $response->getUsername());
            $r = $guzzle->copyRemote($profilePicture, $path);
            if ($r->getStatusCode() === 200) {
                $file = new UploadedFile(
                    $path,
                    'photo.jpg',
                    null,
                    null,
                    true
                );
                //will be handle by vichUploader to update path, name and move
                $user->setAvatarFile($file);
                $user->setAvatarPath($file->getPathname());
            }
        }

        $service = $response->getResourceOwner()->getName();
        if ($service === 'google') {
            if ($response->getUsername() != $user->getGoogleId()) {
                $user->setGoogleId($response->getUsername());
            }
            $user->setGoogleAccessToken($response->getAccessToken());
        } elseif ($service === 'facebook') {
            if ($response->getUsername() != $user->getFacebookId()) {
                $user->setFacebookId($response->getUsername());
            }
            $user->setFacebookAccessToken($response->getAccessToken());
        } else {
            return false;
        }

        return true;
    }

}