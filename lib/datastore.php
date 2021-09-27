<?php
namespace Learning;

use PDO;
use PDOException;
use PDORow;
use Learning\App;
use \ClanCats\Hydrahon\{Builder, BaseQuery};
use \ClanCats\Hydrahon\Query\{Sql, Expression};
use \ClanCats\Hydrahon\Query\Sql\{Select, Exists, Func};

class DataStore 
{
    protected $app;

    protected $dbHandle;

    private $tableName;

    private $columnPrefix;

    private $queryBuilder = null;

    public function __construct(
        PDO $dbHandle,
        string $table,
        string $columnPrefix
    )
    {
        $this->app = App::getInstance();
        $this->dbHandle = $dbHandle;
        $this->tableName = $table;
        $this->columnPrefix = $columnPrefix . '_';

        return $this;
    }

    public function searchTable()
    {
        return $this->searchBuilder()->table($this->getTableName());
    }

    public function searchBuilder() : mixed
    {
        $dbConnection = new Db('mysql', 'localhost', 'root', '', 'learning');
        $this->queryBuilder = new Builder(
            'mysql',
            function ($query, $queryString, $queryParameters) use ($dbConnection)
            {
                try {
                    $statement = $dbConnection->prepare($queryString);
                    $statement->execute($queryParameters);
                    if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface) {
                        return $statement->fetchAll(\PDO::FETCH_ASSOC);
                    } elseif ($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert)
                    {
                        return $dbConnection->lastInsertId();
                    } else 
                    {
                        return $statement->rowCount();
                    }
                } catch (\Exception $e) {
                    echo 'Exception in query builder class';
                    throw new \Exception('Error executing DB Query', 0, $e);
                }
            }
        );

        return $this->queryBuilder;
    }

    public function getTableName() : string
    {
        return $this->tableName;
    }

    public function getColumnPrefix() : string | array
    {
        return $this->columnPrefix;
    }
}
?>