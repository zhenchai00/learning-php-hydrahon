<?php
namespace Learning;

require('app.php');
require('db.php');
require(__DIR__ .  '/../vendor/autoload.php');

use Learning\Db;
use ClanCats\Hydrahon\{Builder, BaseQuery, Exception, TranslatorInterface};
use ClanCats\Hydrahon\Translator\Mysql;
use ClanCats\Hydrahon\Query\{Expression, Sql};
use ClanCats\Hydrahon\Query\Sql\{Base, Table, SelectBase, Select, Insert, FetchableInterface};


class QueryDataStore
{
    protected $builder;
    /**
     * Query builder from Clancats Hydrahon
     * Create sql query builder 
     * https://github.com/ClanCats/Hydrahon
     *
     * @return mixed
     */
    protected function sqlBuilder()
    {
        $dbConnection = new Db ('mysql', 'localhost', 'root', '', 'learning');

        $this->builder = new \ClanCats\Hydrahon\Builder(
            'mysql', 
            function($query, $queryString, $queryParameters) use($dbConnection)
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
                    echo 'Exception in DBConnector class';
                    throw new \Exception('Error executing DB Query', 0, $e);
                }
            }
        );
        return $this->builder;
    }

    /**
     * This getDataTable is used method dbBuilder() to query out the table
     *
     * @param string $table Database Table
     * @return mixed
     */
    public function getDataTable($table) : mixed
    {
        return $this->sqlBuilder()->table($table);
    }
}
?>