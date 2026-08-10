<?php
class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $fields = array_keys($data);
        $values = array_map(function($field) {
            return ':' . $field;
        }, $fields);

        $sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
        $this->db->query($sql);

        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}