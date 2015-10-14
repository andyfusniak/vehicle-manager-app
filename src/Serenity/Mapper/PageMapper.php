<?php
namespace Serenity\Mapper;

use Serenity\Entity\Page;
use Serenity\Hydrator\PageDbHydrator;
use Serenity\Service\SerenityParsedown;

class PageMapper
{
    const COLUMN_PAGE_ID  = 'page_id';
    const COLUMN_PRIORITY = 'priority';
    const COLULN_URL      = 'url';
    const COLUMN_NAME     = 'name';
    const COLUMN_CREATED  = 'created';
    const COLUMN_MODIFIED = 'modified';

    protected static $validColumns = [
        self::COLUMN_PAGE_ID,
        self::COLUMN_PRIORITY,
        self::COLULN_URL,
        self::COLULN_URL,
        self::COLUMN_NAME,
        self::COLUMN_CREATED,
        self::COLUMN_MODIFIED
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
     * @var SerenityParsedown
     */
    protected $parsedown;

    /**
     * @param \PDO $pdo the database adapter
     * @param PageDbHydrator $dbHydrator the database hydrator
     */
    public function __construct(\PDO $pdo,
                                PageDbHydrator $dbHydrator,
                                SerenityParsedown $parsedown)
    {
        $this->pdo = $pdo;
        $this->dbHydrator = $dbHydrator;
        $this->parsedown = $parsedown;
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
        unset($data['page_id']);
        unset($data['created']);
        unset($data['modified']);
        unset($data['page_html']);

        $statement = $this->pdo->prepare('
            INSERT INTO pages (
                page_id, url, name, meta_keywords, meta_desc,
                page_title, markdown, page_html, created, modified
            ) VALUES (
                null, :url, :name, :meta_keywords, :meta_desc, :page_title,
                :markdown, :page_html, NOW(), NOW()
            )
        ');
        $statement->bindValue(':url', $data['url'], \PDO::PARAM_STR);
        $statement->bindValue(':name', $data['name'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_keywords', $data['meta_keywords'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_desc', $data['meta_desc'], \PDO::PARAM_STR);
        $statement->bindValue(':page_title', $data['page_title'], \PDO::PARAM_STR);
        $statement->bindValue(':markdown', $data['markdown'], \PDO::PARAM_STR);
        $statement->bindValue(':page_html', $this->parsedown->text($data['markdown']), \PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * @param int $pageId the primary key
     * @return array associative array of data
     */
    public function fetchByPageIdAssocArray($pageId)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM pages WHERE page_id = :page_id'
        );
        $statement->bindValue(':page_id', (int) $pageId, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $url the url slug for the page
     * @return Page|null null indicates not found
     */
    public function fetchPageByUrl($url)
    {
        $statement = $this->pdo->prepare('
            SELECT *
            FROM pages
            WHERE url = :url
        ');
        $statement->bindValue(':url', (string) $url, \PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($row === false) {
            return null;
        }

        return $this->dbHydrator->hydrate($row, new Page());
    }

    /**
     * @return array
     */
    public function fetchAllAssocArray($orderBy = self::COLUMN_PRIORITY, $orderDirection = 'DESC')
    {
        if (!in_array($orderBy, self::$validColumns)) {
            throw new \Exception(sprintf(
                '%s invalid column passed for orderBy "%s"',
                __METHOD__,
                $orderBy
            ));
        }

        $sql = 'SELECT * FROM pages';
        if (!empty($orderBy)) {
            $sql .= ' ORDER BY ' . $orderBy . (($orderDirection === 'DESC') ? ' DESC' : ' ASC');
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchUrlAndPageNames($orderBy = self::COLUMN_PRIORITY, $orderDirection = 'DESC')
    {
        if (!in_array($orderBy, self::$validColumns)) {
            throw new \Exception(sprintf(
                '%s invalid column passed for orderBy "%s"',
                __METHOD__,
                $orderBy
            ));
        }

        $sql = 'SELECT url, name FROM pages';
        if (!empty($orderBy)) {
            $sql .= ' ORDER BY ' . $orderBy . (($orderDirection === 'DESC') ? ' DESC' : ' ASC');
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function isUrlTaken($url, $pageId = null)
    {
        $sql ='SELECT url FROM pages WHERE url = :url';
        if ($pageId !== null) {
            $sql .= ' AND page_id <> :page_id';
        }
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':url', (string) $url, \PDO::PARAM_STR);
        if ($pageId !== null) {
            $statement->bindValue(':page_id', (int) $pageId, \PDO::PARAM_INT);
        }
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
        unset($data['page_html']);
        $statement = $this->pdo->prepare('
            UPDATE pages
            SET url = :url,
                name = :name,
                meta_keywords = :meta_keywords,
                meta_desc = :meta_desc,
                page_title = :page_title,
                markdown = :markdown,
                page_html = :page_html,
                modified = NOW()
            WHERE page_id = :page_id
        ');
        $statement->bindValue(':url', $data['url'], \PDO::PARAM_STR);
        $statement->bindValue(':name', $data['name'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_keywords', $data['meta_keywords'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_desc', $data['meta_desc'], \PDO::PARAM_STR);
        $statement->bindValue(':page_title', $data['page_title'], \PDO::PARAM_STR);
        $statement->bindValue(':markdown', $data['markdown'], \PDO::PARAM_STR);
        $statement->bindValue(':page_html', $this->parsedown->text($data['markdown']), \PDO::PARAM_STR);
        $statement->bindValue(':page_id', $data['page_id'], \PDO::PARAM_INT);
        $statement->execute();
    }

    public function updatePageOrder(array $data)
    {
        $this->pdo->beginTransaction();

        $priority = 1;
        foreach ($data as $value) {
            $statement = $this->pdo->prepare(
                'UPDATE pages SET priority = :priority WHERE page_id = :page_id'
            );
            $statement->bindValue(':priority', $priority++, \PDO::PARAM_INT);
            $statement->bindValue(':page_id', (int) $value, \PDO::PARAM_INT);
            $statement->execute();
        }

        $this->pdo->commit();
    }

    /**
     * @param int $pageId the page to delete
     */
    public function delete($pageId)
    {
        $statement = $this->pdo->prepare(
            'DELETE FROM pages WHERE page_id = :page_id LIMIT 1'
        );
        $statement->bindValue(':page_id', $pageId, \PDO::PARAM_INT);
        $statement->execute();
    }
}
