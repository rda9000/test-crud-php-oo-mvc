<?php
require_once 'Database.php';

class ContactsGateway extends Database 
{

	public function selectAll($order)
	{
		if (!isset($order)) {
			$order = 'name';
		}
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT * FROM contacts ORDER BY $order ASC");
		$sql->execute();
		// $result = $sql->fetchAll(PDO::FETCH_ASSOC);

		$contacts = array();
		while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
		
			$contacts[] = $obj;
		}
		return $contacts;
	}

	public function selectById($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
		$sql->bindValue(1, $id);
		$sql->execute();
		$result = $sql->fetch(PDO::FETCH_OBJ);
		
		return $result;
	}

	public function insert($name, $phone, $email, $address)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("INSERT INTO contacts (name, phone, email, address) VALUES (?, ?, ?, ?)");
		$result = $sql->execute(array($name, $phone, $email, $address));
	}

	public function edit($name, $phone, $email, $address, $id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("UPDATE contacts set name = ?, phone = ?, email = ?, address = ? WHERE id = ? LIMIT 1");
		$result = $sql->execute(array($name, $phone, $email, $address, $id));
	}

	public function delete($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
		$sql->execute(array($id));
	}
}

?>
