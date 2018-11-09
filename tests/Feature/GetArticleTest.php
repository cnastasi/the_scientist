<?php

declare(strict_types=1);

namespace Tests\Feature;

use Acme\Article\Article;
use Acme\Article\Repository\ArticleRepository;
use App\Integration\Article\Repository\InMemoryArticleRepository;
use Tests\TestCase;

class GetArticleTest extends TestCase
{
    /** @var ArticleRepository */
    private $repository;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->repository = new InMemoryArticleRepository();
        $this->app->instance(ArticleRepository::class, $this->repository);
    }

    /**
     * @test
     */
    public function should_get_an_article()
    {
        /** @var Article $article */
        $article = $this->factoryFaker->instance(Article::class);

        $this->repository->add($article);

        $response = $this->get('api/articles/'.$article->id());

        $response->assertStatus(200);
        $response->assertJson(
            [
                'id' => (string) $article->id(),
                'title' => (string) $article->title(),
                'body' => (string) $article->body(),
            ]
        );
    }

    /**
     * @test
     */
    public function should_not_found_an_article()
    {
        /** @var Article $article */
        $article = $this->factoryFaker->instance(Article::class);

        $response = $this->get('api/articles/'.$article->id());

        $response->assertStatus(404);

        $response->assertJson(
            [
                'message' => \sprintf('Article with ID "%s" was not found', $article->id()),
            ]
        );
    }

    /**
     * @test
     */
    public function should_give_invalid_id()
    {
        $id = 'this-is-a-bad-uui';

        $response = $this->get('api/articles/'.$id);

        $response->assertStatus(400);
        $response->assertJson(['message' => "The given value is not valid to create an articleID. Given \"{$id}\""]);
    }

    /**
     * @test
     */
    public function should_give_unexpected_error()
    {
        /** @var Article $article */
        $article = $this->factoryFaker->instance(Article::class);

        $this->repository->looseConnection();

        $response = $this->get('api/articles/'.$article->id());

        $response->assertStatus(500);
        $response->assertJson(
            [
                'message' => InMemoryArticleRepository::CONNECTION_LOST_MESSAGE,
            ]
        );
    }
}
