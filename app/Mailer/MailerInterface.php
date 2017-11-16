<?php

namespace SigeTurbo\Mailer;

interface MailerInterface
{
    public function byUser($service,$user, $data);
    public function byUsers($service, $users = [], $data);
    public function byRole($role);
    public function byRoles($service, $data, $roles = []);
    public function observerByDirectorGroup($year, $group, $student, $observer);
    public function byDirectorGroups();
    public function byParents($service, $data, $group = [], $family = [], $category = []);
}