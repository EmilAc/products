<?php

namespace App\Security;

use App\Entity\Course;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CourseVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';

    /**
     * @var AccessDecisionManagerInterface
     */
    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports(string $attribute, $subject)
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE]))
        {
            return false;
        }
        if (!$subject instanceof Course)
        {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, [User::ROLE_ADMIN]))
        {
            return true;
        }

        $authenticatedUser = $token->getUser();
        if (!$authenticatedUser instanceof User)
        {
            return false;
        }

//        /**@var Course $tasks*/
//
//        $microPost = $subject;
//
//        return $microPost->getUser()->getId() === $authenticatedUser->getId();
    }
}

