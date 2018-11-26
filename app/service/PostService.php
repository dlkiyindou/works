<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 21:26
 */

namespace Works\Service;


use Works\Entity\DataObject;
use Works\Entity\Post;

class PostService extends AbstractEntityService
{
    const TABLE = 'post';

    /** @var PostService */
    private static $instance;
    /**
     * @return PostService
     */
    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new PostService();
        }

        return static::$instance;
    }

    /** @return string */
    public function getTable()
    {
        return static::TABLE;
    }

    /**
     * @param array $result
     * @return Post
     */
    public function buildEntity(array $result)
    {
        return new Post($result);
    }
}