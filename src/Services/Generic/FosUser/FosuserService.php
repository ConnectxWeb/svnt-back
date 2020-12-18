<?php


namespace App\Service\Generic\FosUser;


use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class FosuserService
{
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var EncoderFactoryInterface
     */
    private $factory;
    /**
     * @var UserManagerInterface
     */
    private $userManager;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * FosuserService constructor.
     * @param SessionInterface $session
     * @param EncoderFactoryInterface $factory
     * @param UserManagerInterface $userManager
     * @param TokenStorageInterface $tokenStorage
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        SessionInterface $session,
        EncoderFactoryInterface $factory,
        UserManagerInterface $userManager,
        TokenStorageInterface $tokenStorage,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->session = $session;
        $this->factory = $factory;
        $this->userManager = $userManager;
        $this->tokenStorage = $tokenStorage;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function manualLogin(UserInterface $user, Request $request = null): bool
    {
        if ($user === null) {
            return false;
        }
        //Handle getting or creating the user entity likely with a posted form
        // The third parameter "main" can change according to the name of your firewall in security.yml
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->tokenStorage->setToken($token);

        // If the firewall name is not main, then the set value would be instead:
        // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
        $this->session->set('_security_main', serialize($token));
        $this->session->save();

        // Fire the login event manually
        if ($request !== null) {
            $event = new InteractiveLoginEvent($request, $token);
            $this->eventDispatcher->dispatch($event/*, "security.interactive_login"*/);
        }

        return true;
    }

    public function manualLoginByPassword($username, $password, Request $request = null): bool
    {
        $user = $this->userManager->findUserByUsernameOrEmail($username);
        if ($user === null) {
            return false;
        }

        if (!$this->isValidPassword($user, $password)) {
            return false;
        }

        return $this->manualLogin($user, $request);
    }

    public function isValidPassword(UserInterface $user, $password)
    {
        $encoder = $this->factory->getEncoder($user);

        return $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
    }
}