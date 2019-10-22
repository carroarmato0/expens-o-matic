<?php

namespace App\Controller;

use App\Entity\User;
use App\Forms\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\NativePasswordEncoder;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
  /**
   * @Route("/admin/users", name="admin_users")
   * @param Request $request
   * @return Response
   */
    public function index(Request $request)
    {
      // Create the User form
      $userForm = $this->createForm(UserFormType::class);

      // Load Request information
      $userForm->handleRequest($request);

      // Check if the User Form was submitted and is valid
      if ($userForm->isSubmitted() && $userForm->isValid()) {
        /** @var User $user */
        $user = $userForm->getData();

        // Use NativePasswordEncoder to hash the password
        $password_encoder = new NativePasswordEncoder();
        $user_password = $password_encoder->encodePassword($user->getPassword(), "");
        $user->setPassword($user_password);

        // Get the Entity Manager
        $entityManager = $this->getDoctrine()->getManager();
        // Prepare entity to be save
        $entityManager->persist($user);
        // Perform the insert statements
        $entityManager->flush();

        return $this->redirectToRoute('admin_users');
      }

      // Get User repository
      $user_repository = $this->getDoctrine()->getRepository(User::class);
      $users = $user_repository->findAll();

      return $this->render('admin/users.html.twig', array(
        'userForm'  => $userForm->createView(),
        'users'     => $users,
      ));
    }
}
