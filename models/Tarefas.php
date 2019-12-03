<?php
class Tarefas extends Model
{

	private $table = 'tarefas';

	/**
	 * Busca um registro no banco de dados
	 */
	public function find($id) {
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}

	/**
	 * Busca todos os registros no banco de dados
	 */
	public function list() {
		$result = array();

		$sql = "SELECT * FROM $this->table";
		$stmt = $this->db->query($sql);
		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $result;
	}

	/**
	 * Adiciona novo registro banco de dados
	 */
	public function add($titulo) {
		$sql = "INSERT INTO $this->table (titulo, status) VALUES (:titulo, 0)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return $id = $this->db->lastInsertId();
		}
		return false;
	}

	/**
	 * Edita status do registro no banco de dados
	 */
	public function updateStatus($status, $id) {
		$sql = "UPDATE $this->table SET status = :status WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':status', $status, PDO::PARAM_INT);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Exclui registro no banco de dados
	 */
	public function delete($id) {
		$sql = "DELETE FROM $this->table WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
}