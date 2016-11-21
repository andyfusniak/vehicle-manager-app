<?php
namespace Vm\Mapper;

use Vm\Entity\Vehicle;
use Vm\Hydrator\VehicleDbHydrator;
use Vm\Service\VmParsedown;

class VehicleMapper
{
    const COLUMN_VEHICLE_ID    = 'vehicle_id';
    const COLUMN_TYPE          = 'type';
    const COLUMN_VISIBLE       = 'visible';
    const COLUMN_SOLD          = 'sold';
    const COLUMN_URL           = 'url';
    const COLUMN_NEW           = 'new';
    const COLUMN_FEATURED      = 'featured';
    const COLUMN_PRICE         = 'price';
    const COLUMN_META_KEYWORDS = 'meta_keywords';
    const COLUMN_META_DESC     = 'meta_desc';
    const COLUMN_PAGE_TITLE    = 'page_title';
    const COLUMN_MARKDOWN      = 'markdown';
    const COLUMN_PAGE_HTML     = 'page_html';
    const COLUMN_CREATED       = 'created';
    const COLUMN_MODIFIED      = 'modified';

    const TYPE_CARAVANS    = 'caravans';
    const TYPE_MOTORHOMES  = 'motorhomes';
    const TYPE_AWNINGRANGE = 'awningrange';
    const TYPE_NEWCARAVANS = 'newcaravans';

    // it makes no sense to sort by some fields such as
    // meta keywords, meta description, page_html, markdown
    protected static $validSortableColumns = [
        self::COLUMN_VEHICLE_ID,
        self::COLUMN_TYPE,
        self::COLUMN_VISIBLE,
        self::COLUMN_SOLD,
        self::COLUMN_NEW,
        self::COLUMN_FEATURED,
        self::COLUMN_URL,
        self::COLUMN_PRICE,
        self::COLUMN_PAGE_TITLE,
        self::COLUMN_CREATED,
        self::COLUMN_MODIFIED
    ];

    protected static $vehicleTypes = [
        self::TYPE_CARAVANS,
        self::TYPE_MOTORHOMES,
        self::TYPE_AWNINGRANGE,
        self::TYPE_NEWCARAVANS
    ];

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var VehicleDbHydrator
     */
    protected $dbHydrator;

    /**
     * @var VmParsedown
     */
    protected $parsedown;

    /**
     * @param \PDO $pdo the database adapter
     * @param VehicleDbHydrator $dbHydrator the hydrator object
     */
    public function __construct(\PDO $pdo,
                                VehicleDbHydrator $dbHydrator,
                                VmParsedown $parsedown)
    {
        $this->pdo = $pdo;
        $this->dbHydrator = $dbHydrator;
        $this->parsedown = $parsedown;
    }

    /**
     * Create a new vehicle row in the database
     *
     * @param Vehicle $vehicle vehicle object
     * @return int the last insert id from the db
     */
    public function insert(Vehicle $vehicle)
    {
        $data = $this->dbHydrator->extract($vehicle);
        $statement = $this->pdo->prepare('
            INSERT INTO vehicles (
                vehicle_id, type, visible, sold, url, new, featured, price,
                meta_keywords, meta_desc, page_title, collection_id,
                markdown, page_html, features, created, modified
            ) VALUES (
                null, :type, :visible, :sold, :url, :new, 0, :price,
                :meta_keywords, :meta_desc, :page_title, :collection_id,
                :markdown, :page_html, :features, NOW(), NOW()
            )
        ');
        unset($data['vehicle_id']);
        unset($data['page_html']);
        unset($data['created']);
        unset($data['modified']);

        $statement->bindValue(':type', $data['type'], \PDO::PARAM_STR);
        $statement->bindValue(':visible', $data['visible'], \PDO::PARAM_INT);
        $statement->bindValue(':sold', $data['sold'], \PDO::PARAM_INT);
        $statement->bindValue(':url', $data['url'], \PDO::PARAM_STR);
        $statement->bindValue(':new', $data['new'], \PDO::PARAM_INT);
        $statement->bindValue(':price', $data['price'], \PDO::PARAM_INT);
        $statement->bindValue(':meta_keywords', $data['meta_keywords'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_desc', $data['meta_desc'], \PDO::PARAM_STR);
        $statement->bindValue(':page_title', $data['page_title'], \PDO::PARAM_STR);
        $statement->bindValue(':collection_id', $data['collection_id'], \PDO::PARAM_INT);
        $statement->bindValue(':markdown', $data['markdown'], \PDO::PARAM_STR);
        $statement->bindValue(':page_html', $this->parsedown->text($data['markdown']), \PDO::PARAM_STR);
        $statement->bindValue(':features', $data['features'], \PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * @param int $vehicleId the primary key
     * @return Vehicle object
     */
    public function fetchByVehicleId($vehicleId)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM vehicles WHERE vehicle_id = :vehicle_id'
        );
        $statement->bindValue(':vehicle_id', (int) $vehicleId, \PDO::PARAM_INT);
        $statement->execute();

        return $this->dbHydrator->hydrate($statement->fetch(\PDO::FETCH_ASSOC), new Vehicle());
    }

    /**
     * @param string $url the url slug of the vehicle
     * @return Vehicle object
     */
    public function fetchByUrl($url)
    {
        $statement = $this->pdo->prepare('
            SELECT * FROM vehicles
            WHERE url = :url
        ');
        $statement->bindValue(':url', $url, \PDO::PARAM_STR);
        $statement->execute();

        return $this->dbHydrator->hydrate($statement->fetch(\PDO::FETCH_ASSOC), new Vehicle());
    }

    /**
     * Fetch the featured vehicle
     * @return Vehicle|null
     */
    public function fetchFeaturedVehicle()
    {
        $statement = $this->pdo->prepare('
            SELECT V.*, I.image_id
            FROM vehicles AS V
            LEFT JOIN (
                SELECT image_id, collection_id
                FROM images AS I
                WHERE priority = 1
            ) AS I
            ON V.collection_id = I.collection_id
            WHERE V.featured = 1
            LIMIT 1
        ');

        $statement->execute();
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($row === false) {
            return null;
        }
        return $row;
    }

    /**
     * Fetch the new-in vehicles
     * @return array associative array of vehicles
     */
    public function fetchNewVehicles()
    {
        $statement = $this->pdo->prepare('
            SELECT V.*, I.image_id
            FROM vehicles AS V
            LEFT JOIN (
                SELECT image_id, collection_id
                FROM images AS I
                WHERE priority = 1
            ) AS I
            ON V.collection_id = I.collection_id
            WHERE V.new = 1 AND V.visible = 1
            LIMIT 2
        ');

        $statement->execute();
        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if ($rows === false) {
            return null;
        }
        return $rows;
    }

    /**
     * Fetch the markdown only by vehicle id
     *
     * @param int $vehicleId the primary key
     * @return string markdown text
     */
    public function fetchMarkdownOnlyByVehicleId($vehicleId)
    {
        $statement = $this->pdo->prepare('
            SELECT markdown
            FROM vehicles
            WHERE vehicle_id = :vehicle_id
        ');
        $statement->bindValue(':vehicle_id', (int) $vehicleId, \PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($row === false) {
            return null;
        }
        return $row['markdown'];
    }

    /**
     * Retrieves a list of vehicle id and names only
     *
     * @return array
     */
    public function fetchVehicleIdAndNameAssocArray()
    {
        $statement = $this->pdo->prepare('
            SELECT vehicle_id, url, page_title
            FROM vehicles
        ');
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @return array
     */
    public function fetchAllAssocArray($orderBy = self::COLUMN_VEHICLE_ID, $orderDirection = 'DESC')
    {
        if (!in_array($orderBy, self::$validSortableColumns)) {
            throw new \Exception(sprintf(
                '%s invalid column passed for orderBy "%s"',
                __METHOD__,
                $orderBy
            ));
        }

        $statement = $this->pdo->prepare(
            'SELECT * FROM vehicles ORDER BY :order_by :order_direction'
        );
        // TODO this type of binding doesn't work

        $statement->bindValue(':order_by', $orderBy, \PDO::PARAM_STR);
        $statement->bindValue(':order_direction', ($orderDirection === 'DESC') ? 'DESC' : 'ASC', \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchAllVisibleByCategoryAssocArray($type, $orderBy = self::COLUMN_PRICE, $orderDirection = 'DESC')
    {
        if (!in_array($type, self::$vehicleTypes)) {
            throw new \Exception(sprintf(
                '%s invalid column passed for type "%s"',
                __METHOD__,
                $type
            ));
        }

        if (!in_array($orderBy, self::$validSortableColumns)) {
            throw new \Exception(sprintf(
                '%s invalid column passed for orderBy "%s"',
                __METHOD__,
                $orderBy
            ));
        }

        $sql = '
            SELECT V.*, I.image_id
            FROM vehicles AS V
            LEFT JOIN (
                SELECT image_id, collection_id
                FROM images AS I
                WHERE priority = 1
            ) AS I
            ON V.collection_id = I.collection_id
            WHERE V.visible = 1 AND type = :type
        ';
        //$sql = 'SELECT * FROM vehicles WHERE type = :type AND visible = 1';
        if (!empty($orderBy)) {
            $sql .= ' ORDER BY ' . $orderBy . (($orderDirection === 'DESC') ? ' DESC' : ' ASC');
        }
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':type', $type, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchVehiclesByDistinctCategoriesPriceDescAssocArray()
    {
        $statement = $this->pdo->prepare('
            SELECT V.*, C.collection_id, C.tagname, C.name AS collection_name
            FROM vehicles AS V
            JOIN collections AS C
                ON V.collection_id = C.collection_id
            WHERE V.type IN (
                SELECT DISTINCT V.type FROM vehicles
            )
            ORDER BY FIELD(V.type, "caravans", "motorhomes", "awningrange", "newcaravans"), price DESC
        ');
        $statement->execute();
        return $statement->fetchAll();
    }

    public function isUrlTaken($url, $vehicleId = null)
    {
        $sql = 'SELECT url FROM vehicles WHERE url = :url';
        if ($vehicleId !== null) {
            $sql .= ' AND vehicle_id <> :vehicle_id';
        }
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':url', (string) $url, \PDO::PARAM_STR);
        if ($vehicleId !== null) {
            $statement->bindValue(':vehicle_id', (int) $vehicleId, \PDO::PARAM_INT);
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
            UPDATE vehicles
            SET type = :type,
                url = :url,
                visible = :visible,
                sold = :sold,
                new = :new,
                price = :price,
                meta_keywords = :meta_keywords,
                meta_desc = :meta_desc,
                page_title = :page_title,
                collection_id = :collection_id,
                markdown = :markdown,
                page_html = :page_html,
                features = :features,
                modified = NOW()
            WHERE vehicle_id = :vehicle_id
        ');
        $statement->bindValue(':type', $data['type'], \PDO::PARAM_STR);
        $statement->bindValue(':url', $data['url'], \PDO::PARAM_STR);
        $statement->bindValue(':visible', $data['visible'], \PDO::PARAM_INT);
        $statement->bindValue(':sold', $data['sold'], \PDO::PARAM_INT);
        $statement->bindValue(':new', $data['new'], \PDO::PARAM_INT);
        $statement->bindValue(':price', $data['price'], \PDO::PARAM_INT);
        $statement->bindValue(':meta_keywords', $data['meta_keywords'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_desc', $data['meta_desc'], \PDO::PARAM_STR);
        $statement->bindValue(':page_title', $data['page_title'], \PDO::PARAM_STR);
        $statement->bindValue(':collection_id', $data['collection_id'], \PDO::PARAM_INT);
        $statement->bindValue(':markdown', $data['markdown'], \PDO::PARAM_STR);
        $statement->bindValue(':page_html', $this->parsedown->text($data['markdown']), \PDO::PARAM_STR);
        $statement->bindValue(':vehicle_id', $data['vehicle_id'], \PDO::PARAM_INT);
        $statement->bindValue(':features', $data['features'], \PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * Update the markdown only for a given vehicle id
     *
     * @param int $vehicleId the primary key
     * @param string $markdown the new markdown text
     */
    public function updateMarkdownOnly($vehicleId, $markdown)
    {
        $statement = $this->pdo->prepare('
            UPDATE vehicles
            SET markdown = :markdown,
                page_html = :page_html
            WHERE vehicle_id = :vehicle_id
        ');
        $statement->bindValue(':vehicle_id', (int) $vehicleId, \PDO::PARAM_INT);
        $statement->bindValue(':markdown', $markdown, \PDO::PARAM_STR);
        $statement->bindValue(':page_html', $this->parsedown->text($markdown), \PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * Feature the given vehicle and unfeatured the rest (mutually exclusively)
     *
     * @param int $vehicleId the vehicle to feature
     */
    public function featuredVehicle($vehicleId)
    {
        $this->pdo->beginTransaction();

        $statement1 = $this->pdo->prepare('
            UPDATE vehicles SET featured = 0
        ');
        $statement1->execute();

        $statement2 = $this->pdo->prepare('
            UPDATE vehicles SET featured = 1 WHERE vehicle_id = :vehicle_id
        ');
        $statement2->bindValue(':vehicle_id', (int) $vehicleId, \PDO::PARAM_INT);
        $statement2->execute();

        $this->pdo->commit();
    }

    /**
     * Delete a vehicle
     * @param int $vehicleId the vehicle to delete
     */
    public function deleteVehicle($vehicleId)
    {
        $statement = $this->pdo->prepare('
            DELETE FROM vehicles
            WHERE vehicle_id = :vehicle_id
        ');
        $statement->bindValue(':vehicle_id', (int) $vehicleId, \PDO::PARAM_INT);
        $statement->execute();
    }

    // ORDER BY FIELD(noticeBy, 'all','auto','email','mobile','nothing')
    // ORDER BY FIELD(type, 'motorhomes', 'caravans', 'awningrange', 'newcaravans');

}
