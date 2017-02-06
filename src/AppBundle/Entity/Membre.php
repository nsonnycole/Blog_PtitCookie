<?PHP
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Table(name="membre")
 * @ORM\Entity
 */

class Membre implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
    /**
     * @ORM\Column(type="string", unique=true)
     */
    public $email;
    /**
     * @ORM\Column(type="string")
     */
    public $password;

    public function getId()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        return null;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRoles()
    {
        return array('ROLE_USER');
    }
    public function eraseCredentials()
    {
    }
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
        ));
    }
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
        ) = unserialize($serialized);
    }
    /**
     * Set email
     *
     * @param string $email
     *
     * @return Membre
     */
    public function setMembrename($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Set password
     *
     * @param string $password
     *
     * @return Membre
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}
