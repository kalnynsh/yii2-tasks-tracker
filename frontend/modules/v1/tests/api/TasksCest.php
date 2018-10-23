<?php

namespace v1\tests\api;

use common\fixtures\TaskFixture;
use common\fixtures\TokenFixture;
use common\fixtures\UserFixture;
use \frontend\modules\v1\tests\ApiTester;

class TasksCest
{
    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
            'token' => [
                'class' => TokenFixture::className(),
                'dataFile' => codecept_data_dir() . 'token.php',
            ],
            'task' => [
                'class' => TaskFixture::className(),
                'dataFile' => codecept_data_dir() . 'task.php',
            ],
        ]);
    }

    public function index(ApiTester $I)
    {
        $I->sendGET('/tasks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            ['title' => 'Reintermediate front-end web services'],
            ['title' => 'Innovate B2C platforms'],
        ]);
        $I->seeHttpHeader('X-Pagination-Total-Count', 2);
    }

    public function indexWithAuthor(ApiTester $I)
    {
        $I->sendGET('/tasks?expand=project_id');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(
            [
                'title' => 'Reintermediate front-end web services',
                'project_id' => 2,
            ]
        );
    }

    // public function search(ApiTester $I)
    // {
    //     $I->sendGET('/tasks?s[title]=Reintermediate');
    //     $I->seeResponseCodeIs(200);
    //     $I->seeResponseContainsJson([
    //         ['title' => 'Reintermediate front-end web services'],
    //     ]);
    //     $I->dontSeeResponseContainsJson([
    //         ['title' => 'Innovate B2C platforms'],
    //     ]);
    //     $I->seeHttpHeader('X-Pagination-Total-Count', 1);
    // }

    public function view(ApiTester $I)
    {
        $I->sendGET('/tasks/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'title' => 'Reintermediate front-end web services',
        ]);
    }

    public function viewNotFound(ApiTester $I)
    {
        $I->sendGET('/tasks/15');
        $I->seeResponseCodeIs(404);
    }

    public function createUnauthorized(ApiTester $I)
    {
        $I->sendPOST('/tasks', [
            'title' => 'Invent some new',
        ]);
        $I->seeResponseCodeIs(401);
    }

    public function create(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendPOST('/tasks', [
            'title' => 'New Task',
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseContainsJson([
            'user_id' => 2,
            'title' => 'New Task',
        ]);
    }

    public function updateUnauthorized(ApiTester $I)
    {
        $I->sendPATCH('/tasks/1', [
            'title' => 'New Task',
        ]);
        $I->seeResponseCodeIs(401);
    }

    public function update(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendPATCH('/tasks/1', [
            'title' => 'Update web services',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'id' => 1,
            'title' => 'Update web services',
        ]);
    }

    public function updateForbidden(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendPATCH('/tasks/2', [
            'title' => 'New Task 2',
        ]);
        $I->seeResponseCodeIs(403);
    }

    public function deleteUnauthorized(ApiTester $I)
    {
        $I->sendDELETE('/tasks/1');
        $I->seeResponseCodeIs(401);
    }

    public function delete(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendDELETE('/tasks/1');
        $I->seeResponseCodeIs(204);
    }

    public function deleteForbidden(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendDELETE('/tasks/2');
        $I->seeResponseCodeIs(403);
    }
}
