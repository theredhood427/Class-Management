<?php

namespace Models;
use \PDO;

class Classes
{
    public $id;
	public $class_name;
    public $code;
    public $class_description;
    public $teacher_id;


	protected $connection;

    public function __construct($class_name, $code, $description, $teacher_id)
	{
		$this->class_name = $class_name;
        $this->code = $code;
        $this->class_description = $description;
        $this->teacher_id = $teacher_id;
    
	}

	public function getId()
	{
		return $this->id;
	}

	public function getClassName()
	{
		return $this->class_name;
	}

	public function getClassCode()
	{
		return $this->code;
	}

    public function getDescription()
	{
		return $this->class_description;
	}

    public function fetchTeacherId()
	{
		return $this->teacher_id;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function addClass()
	{
		try {
			$sql = "INSERT INTO classes SET name=:name, description=:description, class_code=:class_code, employee_number=:employee_number";
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				':name' => $this->getClassName(),
				':description' => $this->getDescription(),
				':class_code' => $this->getClassCode(),
                ':employee_number' => $this->fetchTeacherId()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($name, $description, $class_code,  $teacher_id)
	{
		try {
			$sql = 'UPDATE classes SET name=?, description=?, class_code=?, employee_number=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$name,
				$description,
				$class_code,
                $teacher_id,
				$this ->getId()
			]);


		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM classes WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM classes WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->class_name = $row['name'];
			$this->code = $row['class_code'];
			$this->class_description = $row['description'];
            $this->teacher_id = $row['employee_number'];
			
            
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getClass($id){
		try {
			$sql = 'SELECT * FROM CLASSES WHERE id=? ';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$id
			]);
			$data = $statement->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function showClasses()
	{
		try {
			$sql = 'SELECT classes.id, classes.name, classes.class_code, classes.description, teachers.first_name, teachers.last_name FROM classes JOIN teachers ON classes.employee_number=teachers.employee_number';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}