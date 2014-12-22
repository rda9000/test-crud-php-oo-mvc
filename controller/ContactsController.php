<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/crud_mvc_oop/model/Autoloader.php';
require_once ROOT_PATH . '/model/ContactsService.php';


class ContactsController
{

	private $contactsService = null;

	
		public function __construct()
	{
		$this->contactsService = new ContactsService();
	}

	public function redirect($location)
	{
		header('Location: ' . $location);
	}

	public function handleRequest()
	{
		$op = isset($_GET['op']) ? $_GET['op'] : null;

		try {

			if (!$op || $op == 'list') {
				$this->listContacts();
			} elseif ($op == 'new') {
				$this->saveContact();
			} elseif ($op == 'edit') {
				$this->editContact();
			} elseif ($op == 'delete') {
				$this->deleteContact();
			} elseif ($op == 'show') {
				$this->showContact();
			} else {
				$this->showError("Page not found", "Page for operation " . $op . " was not found!");
			}
		} catch(Exception $e) {
			$this->showError("Application error", $e->getMessage());
		}
	}

	public function listContacts()
	{
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
		$contacts = $this->contactsService->getAllContacts($orderby);
		include ROOT_PATH . '/view/contacts.php';

	}

	public function saveContact()
	{
		$title = 'Add new contact';

		$name 	 = '';
		$phone 	 = '';
		$email 	 = '';
		$address = '';

		$errors = array();

		if (isset($_POST['form-submitted'])) {

			$name 	 = isset($_POST['name']) 	? trim($_POST['name']) 	  : null;
			$phone 	 = isset($_POST['phone']) 	? trim($_POST['phone'])   : null;
			$email 	 = isset($_POST['email']) 	? trim($_POST['email'])   : null;
			$address = isset($_POST['address']) ? trim($_POST['address']) : null;

			try {
				$this->contactsService->createNewContact($name, $phone, $email, $address);
				$this->redirect('index.php');
				return;
			} catch(ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
		// include 'view/contact-form.php';
		include ROOT_PATH . '/view/contact-form.php';
	}

	public function editContact()
	{
		$title  = "Edit Contact";

		$name 	 = '';
		$phone 	 = '';
		$email 	 = '';
		$address = '';
		$id      = $_GET['id'];

		$errors = array();

		$contact = $this->contactsService->getContact($id);

		if (isset($_POST['form-submitted'])) {

			$name 	 = isset($_POST['name']) 	? trim($_POST['name']) 	  : null;
			$phone 	 = isset($_POST['phone']) 	? trim($_POST['phone'])   : null;
			$email 	 = isset($_POST['email']) 	? trim($_POST['email'])   : null;
			$address = isset($_POST['address']) ? trim($_POST['address']) : null;

			try {
				$this->contactsService->editContact($name, $phone, $email, $address, $id);
				$this->redirect('index.php');
				return;
			} catch(ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
		// Include in the view of the edit form
		include ROOT_PATH . 'view/contact-form-edit.php';
	}

	public function deleteContact()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;
			if (!$id) {
				throw new Exception('Internal error');
			}
			$this->contactsService->deleteContact($id);

			$this->redirect('index.php');
	}

	public function showContact()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$errors = array();

		if (!$id) {
			throw new Exception('Internal error');
		}
		$contact = $this->contactsService->getContact($id);

		include ROOT_PATH . 'view/contact.php';
	}

	public function showError($title, $message)
	{
		include ROOT_PATH . 'view/error.php';
	}
}

?>
