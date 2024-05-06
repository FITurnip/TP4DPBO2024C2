<?php
include_once("Views/Type.view.php");
include_once("Models/Type.model.php");

class TypeController{
    public function getIndex() {
        $typeView = new TypeView('body');
        $typeModel = new TypeModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $typeModel->open();
        $typeModel->getAll();
        $allTypesData = [];
        while($row = $typeModel->getResult()) {
            $allTypesData[] = $row;
        }
        $typeView->renderIndex($allTypesData);
        $typeModel->close();
    }

    public function getCreate() {
        $typeview = new TypeView('form');
        $typeview->renderCreateForm();
    }

    public function storeData($datas) {
        $typeModel = new TypeModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $typeModel->open();
        $typeModel->store($datas);
        $typeModel->close();

        header("location:type.php");
        die();
    }

    public function getEdit($typeId) {
        $typeView = new TypeView('form');
        $typeModel = new TypeModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $typeModel->open();
        $typeModel->getById($typeId);
        $typeData = $typeModel->getResult();
        $typeModel->close();
        $typeView->renderEditForm($typeData);
    }

    public function updateData($data, $typeId) {
        $typeModel = new TypeModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $typeModel->open();
        $typeModel->update($data, $typeId);
        $typeModel->close();

        header("location:type.php");
        die();
    }

    public function delete($typeId) {
        $typeModel = new TypeModel(Environment::$db["host"], Environment::$db["user"], Environment::$db["password"], Environment::$db["name"]);
        $typeModel->open();
        $typeModel->delete($typeId);
        $typeModel->close();

        header("location:type.php");
        die();
    }
}