<?php

namespace App\Service;

use App\DTO\ArticleDto;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleService
{

    public function __construct(
        private EntityManagerInterface $em,
        private SluggerInterface $slugger
    )
    {
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Article::class)->findAll();
    }

    public function getOne(int $id): Article
    {
        $article = $this->em->getRepository(Article::class)->findOneBy(['id' => $id]);
        if (!$article) {
            throw new Exception('Article not found');
        }
        return $article;
    }

    public function create(ArticleDto $dto): Article
    {
        $author = $this->em->getRepository(User::class)->findOneBy(['id' => $dto->author_id]);
        if (!$author) {
            throw new Exception('Author not found');
        }

        $article = new Article();
        
        $article->setTitle($dto->title)
            ->setContent($dto->content)
            ->setAuthor($author)
            ->setSlug($this->generateSlug($dto->title))
            ->setCreateAt(new DateTimeImmutable())
            ;

        
        foreach ($dto->categories as $catId) {
            $category = $this->em->getRepository(Category::class)->findOneBy(['id' => $catId]);
            if (!$category) {
                throw new Exception('category '.$catId.' not found');
            }
            $article->addCategory($category);
        }

        $this->em->persist($article);
        $this->em->flush();

        return $article;
    }

    private function generateSlug(string $txt): string
    {
        return $this->slugger->slug($txt)->lower();
    }

    public function edit(int $id, ArticleDto $dto): Article
    {
        $author = $this->em->getRepository(User::class)->findOneBy(['id' => $id]);
        if (!$author) {
            throw new Exception('Author not found');
        }

        $article = $this->em->getRepository(Article::class)->findOneBy(['id' => $id]);
        if (!$article) {
            throw new Exception('Article not found');
        }

        $article->setTitle($dto->title)
            ->setContent($dto->content)
            ->setAuthor($author)
            ->setSlug($this->generateSlug($dto->title));

        
        foreach ($article->getCategories() as $cat) {
            $article->removeCategory($cat);
        }
        foreach ($dto->categories as $catId) {
            $category = $this->em->getRepository(Category::class)->findOneBy(['id' => $catId]);
            if (!$category) {
                throw new Exception('category '.$catId.' not found');
            }
            $article->addCategory($category);
        }

        $this->em->persist($article);
        $this->em->flush();

        return $article;
    }

    public function delete(int $id): void
    {
        $article = $this->em->getRepository(Article::class)->findOneBy(['id' => $id]);
        if (!$article) {
            throw new Exception('Article not found');
        }
        $this->em->remove($article);
        $this->em->flush();
    }
}