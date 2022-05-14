<?php
class Database{
    private $db;
    private $sentence;
    public function __construct() {
        $host = 'localhost';
        $u = 'root';
        $pw = '';
        $database = 'testeo';
        $this->db = new mysqli($host, $u, $pw, $database);
        $this->sentence = $this->db->stmt_init();
    }

    public function getAll($sql) {
        if ($this->sentence->prepare($sql)) {
            $lista = $this->db->query($sql);
            return $lista->fetch_all(MYSQLI_ASSOC);
            $this->sentence->close();
        }
        $this->db->close();
        return null;
    }

    public function consult($sql) {
        if ($this->sentence->prepare($sql)) {
            $lista = $this->db->query($sql);
            $this->sentence->close();
            return $lista->fetch_assoc();
        }

        $this->db->close();

        return null;
    }
    public function execute($sql) {
        $res = $this->db->query($sql);
        $this->db->close();
        return $res;
    }
}
?>