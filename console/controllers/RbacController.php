<?php

namespace console\controllers;

use Yii;
use common\models\User;
use yii\console\ExitCode;
use yii\console\Controller;
use common\rbac\ProfileRule;
use common\rbac\UserGroupRule;
use common\models\group\Group;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Rules
        // $name = 'whichUserGroupAndTeam'
        $userGroupRule = new UserGroupRule();
        $auth->add($userGroupRule);

        // $name = 'isProfileOwner'
        $profileRule = new ProfileRule();
        $auth->add($profileRule);

        // Permissions
        $readProject = $auth->createPermission('readProject');
        $readProject->description = 'Read project description';
        $auth->add($readProject);

        $createProject = $auth->createPermission('createProject');
        $createProject->description = 'Create project';
        $auth->add($createProject);

        $updateProject = $auth->createPermission('updateProject');
        $updateProject->description = 'Update project';
        $auth->add($updateProject);

        $deleteProject = $auth->createPermission('deleteProject');
        $deleteProject->description = 'Delete project';
        $auth->add($deleteProject);
        // End of Project

        $readTask = $auth->createPermission('readTask');
        $readTask->description = 'Read task description';
        $auth->add($readTask);

        $createTask = $auth->createPermission('createTask');
        $createTask->description = 'Create task';
        $auth->add($createTask);

        $updateTask = $auth->createPermission('updateTask');
        $updateTask->description = 'Update task';
        $auth->add($updateTask);

        $deleteTask = $auth->createPermission('deleteTask');
        $deleteTask->description = 'Delete task';
        $auth->add($deleteTask);
        // End of Task
        // Start Profile
        $readProfile = $auth->createPermission('readProfile');
        $readProfile->description = 'Read user`s profile';
        $auth->add($readProfile);

        $createProfile = $auth->createPermission('createProfile');
        $createProfile->description = 'Create profile';
        $auth->add($createProfile);

        $deleteProfile = $auth->createPermission('deleteProfile');
        $deleteProfile->description = 'Delete profile';
        $auth->add($deleteProfile);

        $updateProfile = $auth->createPermission('updateProfile');
        $updateProfile->description = 'Update profile';
        $auth->add($updateProfile);
        // End of Profile. Start OwnProfile
        $updateOwnProfile = $auth->createPermission('updateOwnProfile');
        $updateOwnProfile->description = 'Update own profile';
        $updateOwnProfile->ruleName = $profileRule->name;

        $auth->add($updateOwnProfile);
        $auth->addChild($updateOwnProfile, $updateProfile);
        // Start User
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create user';
        $auth->add($createUser);

        $readUser = $auth->createPermission('readUser');
        $readUser->description = 'Read user`s data';
        $auth->add($readUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update user`s data';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Delete user';
        $auth->add($deleteUser);
        // End of User
        // Start Team
        $createTeam = $auth->createPermission('createTeam');
        $createTeam->description = 'Create Team';
        $auth->add($createTeam);

        $readTeam = $auth->createPermission('readTeam');
        $readTeam->description = 'Read Team`s data';
        $auth->add($readTeam);

        $updateTeam = $auth->createPermission('updateTeam');
        $updateTeam->description = 'Update Team`s data';
        $auth->add($updateTeam);

        $deleteTeam = $auth->createPermission('deleteTeam');
        $deleteTeam->description = 'Delete Team';
        $auth->add($deleteTeam);

        // Administrator
        $admin = $auth->createRole(Group::ADMIN);
        $admin->ruleName = $userGroupRule->name;
        $admin->description = 'Admin';

        $auth->add($admin);

        $auth->addChild($admin, $readProject);
        $auth->addChild($admin, $createProject);
        $auth->addChild($admin, $updateProject);
        $auth->addChild($admin, $deleteProject);

        $auth->addChild($admin, $readTask);
        $auth->addChild($admin, $createTask);
        $auth->addChild($admin, $updateTask);
        $auth->addChild($admin, $deleteTask);

        $auth->addChild($admin, $readTeam);
        $auth->addChild($admin, $createTeam);
        $auth->addChild($admin, $updateTeam);
        $auth->addChild($admin, $deleteTeam);

        $auth->addChild($admin, $readUser);
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $deleteUser);

        $auth->addChild($admin, $readProfile);
        $auth->addChild($admin, $createProfile);
        $auth->addChild($admin, $updateProfile);
        $auth->addChild($admin, $deleteProfile);

        // Teamlead
        $teamlead = $auth->createRole(Group::TEAMLEAD);
        $teamlead->ruleName = $userGroupRule->name;
        $teamlead->description = 'Teamlead';

        $auth->add($teamlead);

        $auth->addChild($teamlead, $readProject);
        $auth->addChild($teamlead, $createProject);
        $auth->addChild($teamlead, $updateProject);
        $auth->addChild($teamlead, $deleteProject);

        $auth->addChild($teamlead, $readTask);
        $auth->addChild($teamlead, $createTask);
        $auth->addChild($teamlead, $updateTask);
        $auth->addChild($teamlead, $deleteTask);

        $auth->addChild($teamlead, $readTeam);
        $auth->addChild($teamlead, $createTeam);
        $auth->addChild($teamlead, $updateTeam);
        $auth->addChild($teamlead, $deleteTeam);

        $auth->addChild($teamlead, $readUser);
        $auth->addChild($teamlead, $createUser);
        $auth->addChild($teamlead, $updateUser);
        $auth->addChild($teamlead, $deleteUser);

        $auth->addChild($teamlead, $readProfile);
        $auth->addChild($teamlead, $createProfile);
        $auth->addChild($teamlead, $updateProfile);
        $auth->addChild($teamlead, $deleteProfile);

        // Assignee (user) -- member of crew
        $assignee = $auth->createRole(Group::ASSIGNEE);
        $assignee->ruleName = $userGroupRule->name;
        $assignee->description = 'Assignee';

        $auth->add($assignee);
        $auth->addChild($assignee, $readProject);
        $auth->addChild($assignee, $readTask);
        $auth->addChild($assignee, $readTeam);
        $auth->addChild($assignee, $readUser);
        $auth->addChild($assignee, $readProfile);
        $auth->addChild($assignee, $createProfile);
        $auth->addChild($assignee, $updateOwnProfile);

        // User (signup) -- not member of crew
        $user = $auth->createRole(Group::USER);
        $user->ruleName = $userGroupRule->name;
        $user->description = 'User';

        $auth->add($user);
        $auth->addChild($user, $readProject);
        $auth->addChild($user, $readTask);

        return ExitCode::OK;
    }
}
