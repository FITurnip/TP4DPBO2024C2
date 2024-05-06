<?php
include_once("Views/Member.view.php");
include_once("Models/Member.model.php");

class MemberController{
    public function getIndex() {
        $memberView = new MemberView('body');
        $memberModel = new MemberModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $memberModel->open();
        $memberModel->getAll();
        $allMembersData = [];
        while($row = $memberModel->getResult()) {
            $allMembersData[] = $row;
        }
        $memberView->renderIndex($allMembersData);
        $memberModel->close();
    }

    public function getCreate() {
        $view = new MemberView('form');
        $view->renderCreateForm();
    }

    public function storeData($datas) {
        $memberModel = new MemberModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $memberModel->open();
        $memberModel->store($datas);
        $memberModel->close();

        header("location:index.php");
        die();
    }

    public function getEdit($memberId) {
        $memberView = new MemberView('form');
        $memberModel = new MemberModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $memberModel->open();
        $memberModel->getById($memberId);
        $memberData = $memberModel->getResult();
        $memberModel->close();

        $memberView->renderEditForm($memberData);
    }

    public function updateData($data, $memberId) {
        $memberModel = new MemberModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $memberModel->open();
        $memberModel->update($data, $memberId);
        $memberModel->close();

        header("location:index.php");
        die();
    }

    public function delete($memberId) {
        $memberModel = new MemberModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $memberModel->open();
        $memberModel->delete($memberId);
        $memberModel->close();

        header("location:index.php");
        die();
    }
}