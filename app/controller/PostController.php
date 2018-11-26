<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 01:44
 */

namespace Works\Controller;


use Works\Entity\Post;
use Works\Service\PostService;
use Works\Service\UserService;

class PostController extends Controller
{
    /** @var PostController */
    private static $instance;

    /**
     * @return PostController
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new PostController();
        }

        return static::$instance;
    }

    public static function getShortName()
    {
        return 'post';
    }

    public function indexAction(array $args = [])
    {
        $userService = UserService::getInstance();
        $allUsers = $userService->getAll();

        $postService = PostService::getInstance();
        $allPosts = $postService->getAll();

        $this->display(
            static::getShortName(),
            'index',
            [
                'allUsers' => $allUsers,
                'allPosts' => $allPosts,
                'currentPost' => new Post(),
            ]);
    }

    public function editAction(array $args = [])
    {
        $id = filter_input(INPUT_POST, 'id');
        if ('POST' === filter_input(INPUT_SERVER, 'REQUEST_METHOD')) {
            $this->save();
            $this->redirect('index.php');
        }

        $postService = PostService::getInstance();
        if (empty($id)) {
            $post = $postService->buildEntity([]);
        } else {
            $post = $postService->get($id);
        }

        $this->display(static::getShortName(), 'edit', ['currentPost' => $post]);
    }

    private function save()
    {
        $postId = filter_input(INPUT_POST, 'id');
        $title = filter_input(INPUT_POST, 'title');
        $content = filter_input(INPUT_POST, 'content');

        $postService = PostService::getInstance();
        if (empty($postId)) {
            $post = $postService->buildEntity([]);
        } else {
            $post = $postService->get($postId);
        }

        $post->setContent($content);
        $post->setTitle($title);
        $postService->save($post);
    }
}