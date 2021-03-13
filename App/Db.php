<?php


namespace App;

use App\Exceptions\DbException;

/**
 * Class Db
 * @package App
 */
class Db
{
    protected $dbh;

    /**
     * Db constructor.
     */
    public function __construct()
    {
        $config = Instance::getInstance();
        $this->dbh = new \PDO('mysql:host=' . $config->data['db']['host'] . ';dbname=' . $config->data['db']['dbname'], $config->data['db']['username'], $config->data['db']['password']);
    }

    /**
     * @param string $sql
     * @param string $class
     * @param array $params
     * @return array
     * @throws DbException
     */
    public function query(string $sql, string $class, array $params = []): array
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($params);

        if (!$result) {
            throw new DbException($sql, 'Request failed');
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * @param string $sql
     * @param string $class
     * @param array $params
     * @return iterable
     * @throws DbException
     */
    public function quickQuery(string $sql, string $class, array $params = []): iterable
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($params);
        $sth->setFetchMode(\PDO::FETCH_CLASS, $class);

        if (!$result) {
            throw new DbException($sql, 'Request failed');
        }

        while ($row = $sth->fetch()) {
            yield $row;
        }
    }

    /**
     * @param $sql
     * @param array $params
     * @return bool
     */
    public function execute($sql, array $params = []): bool
    {
        $sth = $this->dbh->prepare($sql);

        return $sth->execute($params);
    }

    /**
     * @return int
     */
    public function getLastId(): int
    {
        return $this->dbh->lastInsertId();
    }
}
