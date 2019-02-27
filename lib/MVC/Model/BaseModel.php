<?php

namespace lib\MVC\Model;

abstract class BaseModel {

    /**
     *
     * @var String RDBMS yang dipakai, saat ini hanya mysql 
     */
    private static $db_driver = '';

    /**
     *
     * @var String Host database
     */
    private static $host = '';

    /**
     *
     * @var String Username Database
     */
    private static $username = '';

    /**
     *
     * @var String Password Database
     */
    private static $password = '';

    /**
     *
     * @var String Nama Database
     */
    private static $db = '';
    protected static $connection;
    protected $resp;

    /**
     * Melakukan koneksi ke Database
     * @return boolean Hasil koneksi ke Database
     */
    public static function getDB() {

        if (self::$db_driver == 'mysql') {
            if (!isset(self::$connection)) {

                self::$connection = new \mysqli(self::$host, self::$username, self::$password, self::$db);

                if (!self::$connection) {
                    echo 'Cannot connect to database server';
                    exit;
                }
                return self::$connection;
            }
        }
    }

    /**
     * Mengambil data dari Database (Select)
     * @param String $query Query mengambil data dari database
     * @return Array Hasil mengambil data dari database
     */
    public static function getData($query) {
        if ($row = self::getDB()->query($query)) {

            while ($rows = $row->fetch_array()) {
                $resp[] = $rows;
            }

            $resp[rowsnum] = $row->num_rows;
        } else {
            echo $resp = self::$connection->error . '. Your query is : <i>' . $query . '</i>';
        }

        return $resp;
    }

    /**
     * Mengeksekusi Query (Update, Delete, Insert)
     * @param String $query Query eksekusi data ke database
     * @return Array Hasil eksekusi data ke database
     */
    public function execData($query) {
        if (self::getDB()->query($query)) {
            $resp[status] = 'OK';
        } else {
            $resp[status] = 'ERROR';
            $resp[msg] = self::$connection->error . '. Your query is : <i>' . $query . '</i>';
        }
        return $resp;
    }

}
