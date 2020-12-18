<?php


namespace App\Service\Generic\Symfony;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Templating\EngineInterface;

class SymfonyInterface
{
    /**
     * @var UserManagerInterface
     */
    private $userManager;
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    /**
     * @var EngineInterface
     */
    private $templating;
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var SessionInterface
     */
    private $session;


    public function __construct(
        TokenStorageInterface $tokenStorageInterface,
        UserManagerInterface $userManager,
        UrlGeneratorInterface $urlGenerator,
        EngineInterface $templating,
        RequestStack $requestStack,
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        ContainerInterface $container,
        KernelInterface $kernel,
        SessionInterface $session
    ) {
        $this->tokenStorage = $tokenStorageInterface;
        $this->userManager = $userManager;
        $this->urlGenerator = $urlGenerator;
        $this->templating = $templating;
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->container = $container;
        $this->kernel = $kernel;
        $this->session = $session;
    }

    /**
     * @return string|\Stringable|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager(): UserManagerInterface
    {
        return $this->userManager;
    }

    /**
     * @return UrlGeneratorInterface
     */
    public function getUrlGenerator(): UrlGeneratorInterface
    {
        return $this->urlGenerator;
    }

    /**
     * @return EngineInterface
     */
    public function getTemplating(): EngineInterface
    {
        return $this->templating;
    }

    /**
     * @return RequestStack
     */
    public function getRequestStack(): RequestStack
    {
        return $this->requestStack;
    }

    public function getRequest(): ?Request
    {
        return $this->requestStack->getCurrentRequest();
    }

    public function getRequestReferer(): ?string
    {
        $request = $this->getRequest();

        return $request !== null ? $request->headers->get('referer') : null;
    }

    public function isXmlHttpRequest()
    {
        return $this->getRequest()->isXmlHttpRequest();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    /**
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    public function generateUrl(
        string $route,
        array $parameters = [],
        int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH
    ): string {
        return $this->router->generate($route, $parameters, $referenceType);
    }

    public function redirect(string $url, int $status = 302): RedirectResponse
    {
        return new RedirectResponse($url, $status);
    }

    public function redirectToRoute(string $route, array $parameters = [], int $status = 302): RedirectResponse
    {
        return $this->redirect($this->generateUrl($route, $parameters), $status);
    }

    /**
     * @return TokenStorageInterface
     */
    public function getTokenStorage(): TokenStorageInterface
    {
        return $this->tokenStorage;
    }

    /**
     * @return FormFactoryInterface
     */
    public function getFormFactory(): FormFactoryInterface
    {
        return $this->formFactory;
    }

    /**
     * @return KernelInterface
     */
    public function getKernel(): KernelInterface
    {
        return $this->kernel;
    }

    public function projectDir()
    {
        return $this->kernel->getProjectDir();
    }

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }
}