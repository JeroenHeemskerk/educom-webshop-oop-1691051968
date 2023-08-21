<?php

require_once "../../Models/UserModel.php";
require_once "TestUserCrud.php";
require_once "TestUser.php";
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase {

    public function testGetFormFields_FormFieldsEqualTo() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        $user_model->page = "login";
        // run
        $result = $user_model->getFormFields();
        // validate
        $this->assertEquals(array("email"=>"","password"=>""), $result);
    }
    public function testSetEmptyFields_ValuesEqualsTo() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        $user_model->page = "change_password";
        // run
        $result = $user_model->getFormFields();
        // validate
        $this->assertEquals(array("current_password"=>"","new_password"=>"","confirm_new_password"=>""), $result);
    }
    public function testValidateField_ValueEmptyErrors() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        // run
        $user_model->validateField("name","");
        $result = $user_model->errors;
        // validate
        $this->assertEquals(array("name"=>"Name is required"), $result);
    }
    public function testValidateField_NameValidErrorsEmpty() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        // run
        $user_model->validateField("name","Kevin");
        $result = $user_model->errors;
        // validate
        $this->assertEmpty($result);
    }
    public function testValidateField_NameInvalidErrorsEqualsTo() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        // run
        $user_model->validateField("name","+=!@#$%^&*()");
        $result = $user_model->errors;
        // validate
        $this->assertEquals(array("name"=>"Only letters and white space allowed"), $result);
    }
    public function testValidateField_EmailInvalidErrorsEqualsTo() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        // run
        $user_model->validateField("email","mail.com");
        $result = $user_model->errors;
        // validate
        $this->assertEquals(array("email"=>"Invalid email format"), $result);
    }
    public function testValidateField_ConfirmPasswordValidErrorsEmpty() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        $user_model->values["password"] = "test123";
        // run
        $user_model->validateField("confirm_password","test123");
        $result = $user_model->errors;
        // validate
        $this->assertEmpty($result);
    }
    public function testValidateField_ConfirmPasswordInValidErrorsEqualsTo() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        $user_model->values["password"] = "test345";
        // run
        $user_model->validateField("confirm_password","test123");
        $result = $user_model->errors;
        // validate
        $this->assertEquals(array("confirm_password"=>"Passwords do not match. Try again"), $result);
    }
    public function testValidateForm_ValuesEqualTo() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        $user_model->values["test_1"] = "";
        $user_model->values["test_2"] = "";
        $_POST = [];
        $_POST["test_1"] = "My Test";
        $_POST["test_2"] = "Another one";
        // run
        $user_model->validateForm();
        $result = $user_model->values;
        // validate
        $this->assertEquals(array("test_1"=>"My Test","test_2"=>"Another one"), $result);
    }
    public function testValidateForm_OnePostValuesEmptyErrorsEqualTo() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        $user_model->values["test_1"] = "";
        $user_model->values["test_2"] = "";
        $_POST = [];
        $_POST["test_1"] = "";
        $_POST["test_2"] = "Another one";
        // run
        $user_model->validateForm();
        $result = $user_model->errors;
        // validate
        $this->assertEquals(array("test_1"=>"Test 1 is required"), $result);
    }
    public function testValidateContactForm_PageEqualTo() {
        // prepare 
        $user_model = new UserModel(NULL,NULL);
        $user_model->page = 'contact';
        $_POST = [];
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['page'] = 'contact';
        $_POST['gender'] = 'Male';
        $_POST['name'] = 'Kevin';
        $_POST['email'] = 'kevin@mail.com';
        $_POST['phone'] = '0634397789';
        $_POST['subject'] = 'important';
        $_POST['commpref'] = 'Email';
        $_POST['message'] = 'This is a test';
        // run
        $user_model->validateContactForm();
        $result = $user_model->page;
        // validate
        $this->assertEquals("contact_thanks", $result);
    }
    public function testValidateContactForm_OneValueEmptyPageEqualTo() {
        // prepare 
        $user_model = new UserModel(NULL,NULL);
        $user_model->page = 'contact';
        $_POST = [];
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['page'] = 'contact';
        $_POST['gender'] = 'Male';
        $_POST['name'] = '';
        $_POST['email'] = 'kevin@mail.com';
        $_POST['phone'] = '0634397789';
        $_POST['subject'] = 'important';
        $_POST['commpref'] = 'Email';
        $_POST['message'] = 'This is a test';
        // run
        $user_model->validateContactForm();
        $result = $user_model->page;
        // validate
        $this->assertEquals("contact", $result);
    }
    public function testIsEmailNotEmpty_True() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        $user_model->values['email'] = 'test@mail.com';
        // run
        $result = $user_model->isEmailNotEmpty();
        // validate
        $this->assertTrue($result);
    }
    public function testIsEmailNotEmpty_False() {
        // prepare
        $user_model = new UserModel(NULL,NULL);
        $user_model->values['email'] = '';
        // run
        $result = $user_model->isEmailNotEmpty();
        // validate
        $this->assertFalse($result);
    }
    private function createTestUser($id) {
        return new TestUser($id,$id."@mail.com","Name_".$id,"Password_".$id);
    }
    public function testDoesEmailExist_True() {
        // prepare
        $crud = new TestUserCrud();
        $crud->arrayToReturn = $this->createTestUser(1);
        $user_model = new UserModel(NULL,$crud);
        // run
        $result = $user_model->doesEmailExist("test@mail.com");
        // validate
        $this->assertTrue($result);
    }
    public function testDoesEmailExist_False() {
        // prepare
        $crud = new TestUserCrud();
        $crud->arrayToReturn = $this->createTestUser(1);
        $user_model = new UserModel(NULL,$crud);
        // run
        $result = $user_model->doesEmailExist(NULL);
        // validate
        $this->assertFalse($result);
    }
    public function testValidateRegisterForm_PageEqualToLogin() {
        // prepare
        $crud = new TestUserCrud();
        $crud->arrayToReturn = NULL;
        $user_model = new UserModel(NULL,$crud);
        $user_model->page = 'register';
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['page'] = 'register';
        $_POST['email'] = 'test@mail.com';
        $_POST['name'] = 'Testname';
        $_POST['password'] = 'testpass';
        $_POST['confirm_password'] = 'testpass';        
        // run
        $user_model->validateRegisterForm();
        $result = $user_model->page;
        // validate
        $this->assertEquals('login', $result);
    }
    public function testValidateRegisterForm_PageEqualToRegister() {
        // prepare
        $crud = new TestUserCrud();
        $crud->arrayToReturn = $this->createTestUser(4);
        $user_model = new UserModel(NULL,$crud);
        $user_model->page = 'register';
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['page'] = 'register';
        $_POST['email'] = 'test@mail.com';
        $_POST['name'] = 'Testname';
        $_POST['password'] = 'testpass';
        $_POST['confirm_password'] = 'testpass';        
        // run
        $user_model->validateRegisterForm();
        $result = $user_model->page;
        // validate
        $this->assertEquals('register', $result);
    }
    public function testValidateLoginForm_PageEqualToHome() {
        // prepare
        $crud = new TestUserCrud();
        $crud->arrayToReturn = $this->createTestUser(6);
        $user_model = new UserModel(NULL,$crud);
        $user_model->page = 'login';
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['page'] = 'login';
        $_POST['email'] = 'test@mail.com';
        $_POST['password'] = 'Password_6';
        // run
        $user_model->validateLoginForm();
        $result = $user_model->page;
        // validate
        $this->assertEquals('home', $result);
    }
    public function testValidateLoginForm_PageEqualToLogin() {
        // prepare
        $crud = new TestUserCrud();
        $crud->arrayToReturn = $this->createTestUser(6);
        $user_model = new UserModel(NULL,$crud);
        $user_model->page = 'login';
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['page'] = 'login';
        $_POST['email'] = 'test@mail.com';
        $_POST['password'] = 'WrongPassword';
        // run
        $user_model->validateLoginForm();
        $result = $user_model->page;
        // validate
        $this->assertEquals('login', $result);
    }
    public function testValidateChangePassword_PageEqualToHome() {
        // prepare
        $crud = new TestUserCrud();
        $crud->arrayToReturn = $this->createTestUser(9);
        $user_model = new UserModel(NULL,$crud);
        $user_model->page = 'change_password';
        session_start();
        session_unset();
        $_SESSION["user_id"] = 9;
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['page'] = 'change_password';
        $_POST['current_password'] = 'Password_9';
        $_POST['new_password'] = 'newPassword';
        $_POST['confirm_new_password'] = 'newPassword';
        // run
        $user_model->validateChangePasswordForm();
        $result = $user_model->page;
        // validate
        $this->assertEquals("home", $result);
    }
    public function testValidateChangePassword_PageEqualTo() {
        // prepare
        $crud = new TestUserCrud();
        $crud->arrayToReturn = $this->createTestUser(9);
        $user_model = new UserModel(NULL,$crud);
        $user_model->page = 'change_password';
        session_start();
        session_unset();
        $_SESSION["user_id"] = 9;
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['page'] = 'change_password';
        $_POST['current_password'] = 'Password_9';
        $_POST['new_password'] = 'newPassword';
        $_POST['confirm_new_password'] = 'randomPassword';
        // run
        $user_model->validateChangePasswordForm();
        $result = $user_model->page;
        var_dump("errors: ");
        var_dump($user_model->errors);
        // validate
        $this->assertEquals("change_password", $result);
    }
    public function testValidateChangePassword_PageEqualToAgain() {
        // prepare
        $crud = new TestUserCrud();
        $crud->arrayToReturn = $this->createTestUser(9);
        $user_model = new UserModel(NULL,$crud);
        $user_model->page = 'change_password';
        session_start();
        session_unset();
        $_SESSION["user_id"] = 9;
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['page'] = 'change_password';
        $_POST['current_password'] = 'wrongPassword';
        $_POST['new_password'] = 'newPassword';
        $_POST['confirm_new_password'] = 'newPassword';
        // run
        $user_model->validateChangePasswordForm();
        $result = $user_model->page;
        var_dump("errors: ");
        var_dump($user_model->errors);
        // validate
        $this->assertEquals("change_password", $result);
    }
}