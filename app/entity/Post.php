<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 26/11/2018
 * Time: 01:03
 */

namespace Works\Entity;


class Post extends DataObject
{
    private $title;
    private $content;
    private $userId;
    private $parentId;
    private $dateCreation;
    private $dateArchived;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id' :
                    $this->id = $value;
                    break;
                case 'title' :
                    $this->title = $value;
                    break;
                case 'content' :
                    $this->content;
                    break;
                case 'user_id' :
                    $this->userId = $value;
                    break;
                case 'parent_id' :
                    $this->parentId = $value;
                    break;
                case 'date_creation' :
                    $this->dateCreation = $value;
                    break;
                case 'date_archived' :
                    $this->dateArchived = $value;
                    break;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getDateArchived()
    {
        return $this->dateArchived;
    }

    /**
     * @param mixed $dateArchived
     */
    public function setDateArchived($dateArchived)
    {
        $this->dateArchived = $dateArchived;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => $this->userId,
            'parent_id' => $this->parentId,
            'date_creation' => $this->dateCreation,
            'date_archived' => $this->dateArchived
        ];
    }
}