<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\MailService;
use Doctrine\ORM\EntityManager;
use PHPUnit\Runner\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Twig_Environment as Twig;

class UserController extends BaseController
{
    protected $request;
    protected $response;
    protected $em;
    protected $twig;
    protected $mail;

    /**
     * UserController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param EntityManager $em
     * @param Twig $twig
     * @param MailService $mail
     */
    public function __construct(
        Request $request,
        Response $response,
        EntityManager $em,
        Twig $twig,
        MailService $mail
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->em = $em;
        $this->twig = $twig;
        $this->mail = $mail;
    }

    /**
     * Register action
     *
     * @return string
     */
    public function register()
    {
        try {
            $input = json_decode(
                $this->request->getContent(),
                true
            );

            $user = new User();
            $username = trim($input['username']);

            $user->setUsername($username)
                ->setPassword($input['password'])
                ->setActivationToken()
                ->setIsActive(false)
                ->timestamp();

            /** Save user */
            $this->em->persist($user);
            $this->em->flush();

            /** Send activation code */
            $this->mail->sendActivationCode(
                $username,
                $user->getActivationToken()
            );

            return json_encode(['success' => true]);

        } catch (\Exception $e) {
            return $this->unsuccess($e->getMessage());
        }
    }

    /**
     * Activate user account
     *
     * @return string
     */
    public function activateAccount()
    {
        try {
            $user = $this->em
                ->getRepository(User::class)
                ->findOneBy([
                    'username' => $this->request->get('mail'),
                    'activationToken' => $this->request->get('code'),
                ]);

            if (!$user instanceof User) {
                throw new Exception();
            }

            $user->setIsActive(true);
            $this->em->persist($user);
            $this->em->flush();

            $this->redirect();

        } catch (\Exception $e) {

            /** Redirect to main page */
            $this->redirect();
        }
    }

    /**
     * Login action
     *
     * @return string
     */
    public function login()
    {
        try {
            $input = json_decode(
                $this->request->getContent(),
                true
            );

            /** @var User $user */
            $user = $this->em
                ->getRepository(User::class)
                ->findOneBy([
                    'username' => $input['username'],
                ]);

            if (!$user instanceof User) {
                throw new \Exception('Unauthorized');
            }

            if ($user->getPassword() !== md5($input['password'])) {
                throw new \Exception('Incorrect password');
            }

            if (!$user->getIsActive()) {
                throw new \Exception('Confirm user via email');
            }

            $token = rand_str();
            $user->setAccessToken($token);
            $this->em->persist($user);
            $this->em->flush();

            return json_encode([
                'success' => true,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return $this->unsuccess($e->getMessage());
        }
    }

    /**
     * Change password action
     * @return string
     */
    public function changePassword()
    {
        try {
            $input = json_decode(
                $this->request->getContent(),
                true
            );

            /** @var User $user */
            $user = $this->em
                ->getRepository(User::class)
                ->findOneBy([
                    'accessToken' => $input['token'],
                ]);

            if (!$user instanceof User) {
                throw new \Exception('Unauthorized');
            }

            if ($user->getPassword() !== md5($input['oldPassword'])) {
                throw new \Exception('Incorrect old password');
            }

            $user->setPassword($input['newPassword']);
            $this->em->persist($user);
            $this->em->flush();

            return json_encode(['success' => true]);
        } catch (\Exception $e) {
            return $this->unsuccess($e->getMessage());
        }
    }

    /**
     * Check user token
     * @return string
     */
    public function check()
    {
        try {
            /** @var User $user */
            $user = $this->em
                ->getRepository(User::class)
                ->findOneBy([
                    'accessToken' => $this->request->query->get('token'),
                ]);

            return json_encode([
                'success' => $user instanceof User,
            ]);
        } catch (\Exception $e) {
            return $this->unsuccess($e->getMessage());
        }
    }
}