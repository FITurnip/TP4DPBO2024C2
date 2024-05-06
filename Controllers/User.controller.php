<?php
include_once("Views/User.view.php");
include_once("Models/User.model.php");
include_once("Models/Member.model.php");
include_once("Models/Type.model.php");

class UserController{
    public function getIndex() {
        $userView = new UserView('body');
        $userModel = new UserModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $userModel->open();
        $userModel->getAll();
        $allUsersData = [];
        while($row = $userModel->getResult()) {
            $allUsersData[] = $row;
        }
        $userView->renderIndex($allUsersData);
        $userModel->close();
    }

    public function getMemberData() {
        $memberModel = new MemberModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $memberModel->open();
        $memberModel->getAll();
        $allMembersData = [];
        while($row = $memberModel->getResult()) {
            $allMembersData[] = $row;
        }
        $memberModel->close();

        return $allMembersData;
    }

    public function getTypeData() {
        $memberModel = new TypeModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $memberModel->open();
        $memberModel->getAll();
        $allTypesData = [];
        while($row = $memberModel->getResult()) {
            $allTypesData[] = $row;
        }
        $memberModel->close();

        return $allTypesData;
    }

    public function getCreate() {
        $userview = new UserView('form');
        $allMembersData = $this->getMemberData();
        $allTypesData = $this->getTypeData();
        $userview->renderCreateForm($allMembersData, $allTypesData);
    }

    public function storeData($datas) {
        $userModel = new UserModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $userModel->open();
        $userModel->store($datas);
        $userModel->close();

        header("location:user.php");
        die();
    }

    public function getEdit($userId) {
        $userView = new UserView('form');
        $userModel = new UserModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $userModel->open();
        $userModel->getById($userId);
        $userData = $userModel->getResult();
        $userModel->close();

        $userData["members"] = $this->getMemberData();
        $userData["types"] = $this->getTypeData();

        $userView->renderEditForm($userData);
    }

    public function updateData($data, $userId) {
        $userModel = new UserModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $userModel->open();
        $userModel->update($data, $userId);
        $userModel->close();

        header("location:user.php");
        die();
    }

    public function delete($userId) {
        $userModel = new UserModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $userModel->open();
        $userModel->delete($userId);
        $userModel->close();

        header("location:user.php");
        die();
    }
}