<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{

  private $passwordEncoder;

  public function __construct(UserPasswordEncoderInterface $passwordEncoder)
  {
    $this->passwordEncoder = $passwordEncoder;
  }

  public function load(ObjectManager $manager)
  {
    // Load default Admin user
    $user = new User();
    $user->setName("admin");
    $user->setSurname("admin");
    $user->setEmail("admin@localhost");
    $user->setPassword( $this->passwordEncoder->encodePassword($user, "admin") );
    $user->setRoles(['ROLE_ADMIN']);
    $manager->persist($user);
    $manager->flush();
  }
}
