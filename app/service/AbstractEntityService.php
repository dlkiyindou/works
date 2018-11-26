<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 23:00
 */

namespace Works\Service;


use Works\Configuration;
use Works\Entity\DataObject;

abstract class AbstractEntityService
{
    /**
     * @param DataObject $dataObject
     * @return DataObject
     */
    public function save(DataObject $dataObject) {
        $db = Configuration::getInstance()->getDB();
        $data = $dataObject->toArray();

        if ($dataObject->getId() === null) {
            unset($data['id']);
        }

        $keys = $params = array_keys($data);
        array_walk($params, function (&$element) {$element = ':'.$element;});

        if ($dataObject->getId() === null) {
            $sql = 'INSERT INTO ' . $this->getTable() . ' (' . implode(',', $keys) . ') VALUES (' .implode(',', $params). ')';
        } else {
            array_walk($keys, function (&$element) {$element = $element.'=:'.$element;});
            $sql = 'UPDATE ' . $this->getTable() .  ' SET ' . implode(', ', $keys) . ' WHERE id=:id';
        }

        $stm = $db->prepare($sql);
        foreach ($data as $key => $value) {
            $stm->bindValue(':' . $key, $value);
        }

        $stm->execute();

        if ($dataObject->getId() == null) {
            $dataObject->setId($db->lastInsertId());
        }

        return $dataObject;
    }

    /**
     * @return array
     */
    public function getAll() {
        $db = Configuration::getInstance()->getDB();
        $stm = $db->prepare('SELECT * FROM ' . $this->getTable());
        $stm->execute();
        $results = $stm->fetchAll(\PDO::FETCH_ASSOC);

        $data = [];
        foreach ($results as $result) {
            $data[] = $this->buildEntity($result);
        }

        return $data;
    }

    /**
     * @param $id
     * @return DataObject
     */
    public function get($id) {
        $db = Configuration::getInstance()->getDB();
        $stm = $db->prepare('SELECT * FROM ' .$this->getTable(). ' WHERE id=:id');
        $stm->bindValue(':id', $id);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_ASSOC);

        return $this->buildEntity($result);
    }

    /** @return string */
    public abstract function getTable();

    /** @return DataObject */
    public abstract function buildEntity(array $result);
}