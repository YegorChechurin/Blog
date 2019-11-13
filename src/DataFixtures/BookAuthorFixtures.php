<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Book;
use App\Entity\Author;

class BookAuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$authors = [];
        for ($i=0; $i < 10; $i++) { 
        	$author = new Author();
        	$author->setName('author'.$i);
        	$authors[] = $author;
        }

        $books = [];
        for ($i=0; $i < 4; $i++) { 
        	$author = new Book();
        	$author->setName('book'.$i);
        	$books[] = $book;
        }

        for ($i=0; $i < 2; $i++) { 
        	$books[i]->addAuthor($authors[$i]);
        }

        for ($i=2; $i < 5; $i++) { 
        	$books[2]->addAuthor($authors[$i]);
        }

        for ($i=5; $i < 10; $i++) { 
        	$books[3]->addAuthor($authors[$i]);
        }

        foreach ($authors as $a) {
        	$manager->persist($a);
        }

        foreach ($books as $b) {
        	$manager->persist($b);
        }

        $manager->flush();
    }
}
SELECT book_id, COUNT(author_id) FROM `author_book` GROUP BY book_id HAVING COUNT(author_id) > 1

SELECT book.title FROM `book`
JOIN author_book
ON book.id = author_book.book_id
WHERE author_book.book_id IN (
    SELECT book_id FROM `author_book` GROUP BY book_id HAVING COUNT(author_id) > 1
)

SELECT id, title FROM `book` WHERE id IN (
    SELECT book_id FROM `author_book` GROUP BY book_id HAVING COUNT(author_id) > 1
)



SELECT book.title FROM `book`
JOIN author_book
ON book.id = author_book.book_id
GROUP BY author_book.book_id 
HAVING COUNT(author_book.author_id) > 1

// The above will give the same result as the below

SELECT book.title FROM `book`
JOIN author_book
ON book.id = author_book.book_id
GROUP BY author_book.book_id 
HAVING COUNT(book.title) > 1