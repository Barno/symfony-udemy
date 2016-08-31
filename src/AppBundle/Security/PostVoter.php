<?php
/**
 * Created by PhpStorm.
 * User: bob
 * Date: 31/08/16
 * Time: 20:38
 */

namespace AppBundle\Security;


use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PostVoter extends Voter
{
    const DELETE = 'delete';
    const VIEW = 'view';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, array(self::DELETE))) {
            return false;
        }

        if(!$subject instanceof Post){
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if(!$user instanceof User){
            return false;
        }

        foreach($token->getRoles() as $role){
            if(in_array($role->getRole(),['ROLE_MODERATOR','ROLE_ADMIN'])){
                return true;
            }
        }

        $post = $subject;

        switch($attribute){
            case self::DELETE:
                return $this->canDelete($post,$user);
        }

    }

    private function canDelete(Post $post, User $user){
        return $user === $post->getUsers();
    }


}