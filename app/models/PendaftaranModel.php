<?php
class PendaftaranModel extends Model {
    protected $table = 'pendaftaran';

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        try {
            $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC');
            $result = $this->db->resultSet();
            return $result ?: [];
        } catch (Exception $e) {
            error_log("Error getAll: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByNis($nis) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nis = :nis');
        $this->db->bind(':nis', $nis);
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

    public function search($keyword) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE 
            nama_lengkap LIKE :keyword OR 
            kelas LIKE :keyword OR 
            nis LIKE :keyword OR
            tempat_lahir LIKE :keyword OR
            alamat_rumah LIKE :keyword
            ORDER BY created_at DESC');
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function countTotal() {
        try {
            $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
            $result = $this->db->single();
            return $result ? (int)$result['total'] : 0;
        } catch (Exception $e) {
            error_log("Error countTotal: " . $e->getMessage());
            return 0;
        }
    }

    public function countToday() {
        try {
            $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE DATE(created_at) = CURDATE()');
            $result = $this->db->single();
            return $result ? (int)$result['total'] : 0;
        } catch (Exception $e) {
            error_log("Error countToday: " . $e->getMessage());
            return 0;
        }
    }

    public function countThisMonth() {
        try {
            $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())');
            $result = $this->db->single();
            return $result ? (int)$result['total'] : 0;
        } catch (Exception $e) {
            error_log("Error countThisMonth: " . $e->getMessage());
            return 0;
        }
    }
}