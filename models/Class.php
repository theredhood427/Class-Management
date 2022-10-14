<?php

namespace models;
use \PDO;

class Classes
{
    protected $id;
    protected $name;
    protected $description;
    protected $class_code;


    public function __construct($name, $description, $class_code)
    {
        $this->name = $name;
        $this->description = $description;
        $this->class_code = $class_code;

    }


    public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getClassCode()
	{
		return $this->class_code;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function save()
	{
		try {
			$sql = "INSERT INTO classes SET name=:name, description=:description, class_code=:class_code";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':name' => $this->getName(),
				':description' => $this->getDescription(),
				':class_code' => $this->getClassCode(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function update($name, $description, $code)
	{
		try {
			$sql = 'UPDATE classes SET name=?, description=?, code=? WHERE id = ?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$name,
                $description,
                $code,
                $this->getId()

			]);
			$this->name = $name;
			$this->description = $description;
			$this->code = $code;
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

    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM classes';
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}