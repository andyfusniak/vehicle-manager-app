<?php
namespace Serenity\Mapper;

use Serenity\Entity\Page;
use Serenity\Hydrator\PageDbHydrator;

class PageMapper
{
    const COLUMN_PAGE_ID = 'page_id';

    protected static $validColumns = [
        self::COLUMN_PAGE_ID
    ];

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var PageDbHydrator
     */
    protected $dbHydrator;

    /**
     * @param \PDO $pdo the database adapter
     * @param PageDbHydrator $dbHydrator the database hydrator
     */
    public function __construct(\PDO $pdo, PageDbHydrator $dbHydrator)
    {
        $this->pdo = $pdo;
        $this->dbHydrator = $dbHydrator;
    }

    /**
     * Create a new page row in the database
     *
     * @param Page $page page object
     * @return int the last insert id from the db
     */
    public function insert(Page $page)
    {
        $data = $this->dbHydrator->extract($page);
        $statement = $this->pdo->prepare(
            'INSERT INTO pages (page_id, url, meta_keywords, meta_desc, page_title, markdown, page_html, created, modified) VALUES (null, :url, :meta_keywords, :meta_desc, :page_title, :markdown, :page_html, NOW(), NOW())'
        );
        $statement->bindValue(':url', $data['url'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_keywords', $data['meta_keywords'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_desc', $data['meta_desc'], \PDO::PARAM_STR);
        $statement->bindValue(':page_title', $data['page_title'], \PDO::PARAM_STR);
        $statement->bindValue(':markdown', $data['markdown'], \PDO::PARAM_STR);
        $statement->bindValue(':page_html', $data['page_html'], \PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * @param int $pageId the primary key
     * @return array associative array of data
     */
    public function fetchByPageId($pageId)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM pages WHERE page_id = :page_id'
        );
        $statement->bindValue(':page_id', (int) $pageId, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function fetchAllAssocArray($orderBy = self::COLUMN_PAGE_ID, $orderDirection = 'DESC')
    {
        if (!in_array($orderBy, self::$validColumns)) {
            throw new \Exception(sprintf(
                '%s invalid column passed for orderBy "%s"',
                __METHOD__,
                $orderBy
            ));
        }

        $statement = $this->pdo->prepare(
            'SELECT * FROM pages ORDER BY :order_by :order_direction'
        );
        $statement->bindValue(':order_by', $orderBy, \PDO::PARAM_STR);
        $statement->bindValue(':order_direction', ($orderDirection === 'DESC') ? 'DESC' : 'ASC', \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function isUrlTaken($url)
    {
        $statement = $this->pdo->prepare(
            'SELECT url FROM pages WHERE url = :url'
        );
        $statement->bindValue(':url', (string) $url, \PDO::PARAM_STR);
        $statement->execute();
        if (is_array($statement->fetch(\PDO::FETCH_ASSOC))) {
            return true;
        }
        return false;
    }

    /**
     * @param array $data associative array of data
     */
    public function update($data)
    {
        $statement = $this->pdo->prepare('
            UPDATE pages
            SET url = :url, meta_keywords = :meta_keywords, meta_desc = :meta_desc
                page_title = :page_title, markdown = :markdown,
                page_html = :page_html, modified = NOW()
            WHERE page_id = :page_id
        ');
        $statement->bindValue(':url', $data['url'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_keywords', $data['meta_keywords'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_desc', $data['meta_desc'], \PDO::PARAM_STR);
        $statement->bindValue(':page_title', $data['page_title'], \PDO::PARAM_STR);
        $statement->bindValue(':markdown', $data['markdown'], \PDO::PARAM_STR);
        $statement->bindValue(':page_html', $data['page_html'], \PDO::PARAM_STR);
        $statement->bindValue(':page_id', $data['page_id'], \PDO::PARAM_INT);
        $statement->execute();
    }
}
