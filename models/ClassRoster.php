<?php

namespace models;
use \PDO;

class Student
{
    protected $id;
    protected $class_code;
    protected $student_number;


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


	public function getStudentNumber()
	{
		return $this->student_number;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function save()
	{
		try {
			$sql = "INSERT INTO class_roster SET class_code=:class_code, student_number=:student_number";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':class_code' => $this->getClassCode(),
                ':student_number' => $this->getStudentNumber(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function update($class_code, $student_number)
	{
		try {
			$sql = 'UPDATE class_roster SET class_code=?, student_number=? WHERE id = ?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$class_code,
				$student_number,
                $this->getId()

			]);
			$this->class_code = $class_code;
			$this->student_number = $student_number;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
        
	}
    public function delete()
	{
		try {
			$sql = 'DELETE FROM class_roster WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM class_roster';
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
}

}