<?php 

include"DB.php";
class Student 
{
	private $name;
	private $email;
	private $phone;


	public function setName($name){
		$this->name = $name;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function setPhone($phone){
		$this->phone = $phone;
	}


	public function insert()
	{
		$sql = "INSERT INTO tbl_student(name, email, phone) VALUES(:name, :email, :phone)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':phone', $this->phone);
		return $stmt->execute();
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM tbl_student WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function update($id)
	{
		$sql = "UPDATE  tbl_student SET name =:name, email=:email, phone=:phone WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':phone', $this->phone);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}

	public function readAll()
	{
		$sql = "SELECT * FROM tbl_student";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function delete($id)
	{
		$sql = "DELETE FROM tbl_student WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}
}
?>