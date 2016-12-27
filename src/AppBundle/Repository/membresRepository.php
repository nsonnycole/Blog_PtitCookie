<?php
namespace AppBundle\Repository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\emailNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class UserRepository extends \Doctrine\ORM\EntityRepository implements UserLoaderInterface
{
    public function AfficheMembre($email)
    {
        $user = $this->createQueryBuilder('m')
            ->where('m.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
        if (null === $user) {
            $message = sprintf(
                'Aucun membre ne correspond à ce membre "%s".',
                $email
            );
            throw new emailNotFoundException($message);
        }
        return $user;
    }

}
