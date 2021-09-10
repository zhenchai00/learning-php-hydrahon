<?php
namespace Learning;

require 'db.php';
require(__DIR__ .  '/../vendor/autoload.php');

use Learning\Db;
use ClanCats\Hydrahon\{Builder, BaseQuery, Exception, TranslatorInterface};
use ClanCats\Hydrahon\Translator\Mysql;
use ClanCats\Hydrahon\Query\{Expression, Sql};
use ClanCats\Hydrahon\Query\Sql\{Base, Table, SelectBase, Select, Insert};

class QueryBuilder
{
    public $dbConnection;

    /**
     * Query builder from Clancats Hydrahon
     * https://github.com/ClanCats/Hydrahon
     *
     * @return object
     */
    public function getBuilder()
    {
        $this->dbConnection = new Db ('mysql', 'localhost', 'root', '', 'learning');

        $conn = $this->dbConnection;

        $builder = new \ClanCats\Hydrahon\Builder(
            'mysql', 
            function($query, $queryString, $queryParameters) use($conn) {
                try {
                    // echo '<pre>'; var_dump($queryParameters) ; exit();
                    $statement = $conn->prepare($queryString);
                    $statement->execute($queryParameters);
                    if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface) {
                        return $statement->fetchAll(\PDO::FETCH_ASSOC);
                    } elseif ($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert)
                    {
                        return $conn->lastInsertId();
                    } else 
                    {
                        return $statement->rowCount();
                    } 
                } catch (Exception $e) {
                    echo 'Exception in DBConnector class';
                    throw new Exception('Error executing DB Query', 0, $e);
                }
        
                
            }
        );
        return $builder;
    }

}

// $dbConnection = new Db ('mysql', 'localhost', 'root', '', 'learning');

/**
 * Create a MySQL query builder object 
 * https://clancats.io/hydrahon/master/implementation/mysql-pdo-implementation
 */
/* $builderDb = new \ClanCats\Hydrahon\Builder('mysql', function($query, $queryString, $queryParameters) use($dbConnection)
{
    $statement = $dbConnection->prepare($queryString);
    $statement->execute($queryParameters);

    // when the query is fetchable return all results and let hydrahon do the rest
    // (there's no results to be fetched for an update-query for example)
    if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface)
    {
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    // when the query is a instance of a insert return the last inserted id  
    elseif($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert)
    {
        return $dbConnection->lastInsertId();
    }
    // when the query is not a instance of insert or fetchable then
    // return the number os rows affected
    else 
    {
        return $statement->rowCount();
    }   
});  */

?>