<?php

namespace models;
use Exception;
use \PDO;

class ClassRoster
{
    protected $id;
    protected $class_code;
    protected $student_number;
	protected $enrolled_at;

    protected $connection;

    public function __construct($class_code,  $student_number)
    {
        $this->class_code = $class_code;
        $this->student_number = $student_number;
		
    }


    public function getId()
	{
		return $this->id;
	}

	public function getClassCode()
	{
		return $this->class_code;
	}

	public function getEnrolledAt()
	{
		return $this->enrolled_at;
	}


	public function getStudentNumber()
	{
		return $this->student_number;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

//display 
    public function showRosters(){
		try {
			$sql = "SELECT DISTINCT(c.class_code), c.name, t.first_name, t.last_name, (SELECT COUNT(student_number) FROM class_rosters WHERE  class_code = c.class_code)  AS student_number FROM classes AS c JOIN teachers AS t ON c.employee_number = t.employee_number;";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

//view
public function viewRoster($class_code){
	try {
		$sql = "SELECT cr.id, s.first_name, s.last_name, s.student_number, s.email, s.contact_number, s.program, cr.enrolled_at FROM class_rosters AS cr JOIN students AS s ON cr.student_number = s.student_number WHERE cr.class_code=:class_code";
		$statement = $this->connection->prepare($sql);
		$statement->execute([
			':class_code' => $class_code
		]);

		return $statement->fetchAll();

	} catch (Exception $e) {
		error_log($e->getMessage());
	}
}


    public function delete()
	{
		try {
			$sql = 'DELETE FROM class_rosters WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				':id' => $this->getId()

			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

public function getById($id){
	try {
		$sql = "SELECT * FROM class_rosters WHERE id=:id";
		$statement = $this->connection->prepare($sql);
		$statement->execute([
			':id' => $id
		]);

		$row = $statement->fetch();
		
		$this->id = $row['id'];
		$this->class_code = $row['class_code'];
		$this->student_number = $row['student_number'];
		$this->enrolled_at = $row['enrolled_at'];

	} catch (Exception $e) {
		error_log($e->getMessage());
	}
}

public function addRoster(){
	try {
		$sql = "INSERT INTO class_rosters SET class_code=:class_code, student_number=:student_number";
		$statement = $this->connection->prepare($sql);

		return $statement->execute([
			':class_code' => $this->getClassCode(),
			':student_number' => $this->getStudentNumber(),
		]);

	} catch (Exception $e) {
		error_log($e->getMessage());
	}
}



}