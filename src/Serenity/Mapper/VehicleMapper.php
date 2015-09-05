<?php
namespace Serenity\Mapper;

use Serenity\Entity\Vehicle;
use Serenity\Hydrator\VehicleDbHydrator;

class VehicleMapper
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var VehicleDbHydrator
     */
    protected $hydrator;

    /**
     * @param \PDO $pdo the database adapter
     * @param VehicleDbHydrator $hydrator database object hydrator and extractor
     */
    public function __construct(\PDO $pdo, VehicleDbHydrator $hydrator)
    {
        $this->pdo = $pdo;
        $this->hydrator = $hydrator;
    }

    /**
     * Create a new vehicle row in the database
     *
     * @param Vehicle the vehicle object to persist
     * @return int the last insert id from the db
     */
    public function insert(Vehicle $vehicle)
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO vehicles (vehicle_id, type, visible, sold, url, price, meta_keywords, meta_desc, page_title, markdown, page_html, created, modified) VALUES (null, :type, 1, 0, :url, :price, :meta_keywords, :meta_desc, :page_title, :markdown, :page_html, now(), now())'
        );
        $data = $this->hydrator->extract($vehicle);
        unset($data['vehicle_id']);
        unset($data['visible']);
        unset($data['sold']);
        unset($data['created']);
        unset($data['modified']);
        $statement->bindValue(':type', $data['type'], \PDO::PARAM_STR);
        $statement->bindValue(':url', $data['url'], \PDO::PARAM_STR);
        $statement->bindValue(':price', $data['price'], \PDO::PARAM_INT);
        $statement->bindValue(':meta_keywords', $data['meta_keywords'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_desc', $data['meta_desc'], \PDO::PARAM_STR);
        $statement->bindValue(':page_title', $data['page_title'], \PDO::PARAM_STR);
        $statement->bindValue(':markdown', $data['markdown'], \PDO::PARAM_STR);
        $statement->bindValue(':page_html', $data['page_html'], \PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function fetchByVehicleId($vehicleId)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM vehicles WHERE vehicle_id = :vehicle_id'
        );
        $statement->bindValue(':vehicle_id', (int) $vehicleId, \PDO::PARAM_INT);

        $statement->execute();
        $data = $statement->fetch(\PDO::FETCH_ASSOC);

        $vehicle = new Vehicle();
        $this->hydrator->hydrate($data, $vehicle);
        return $vehicle;
    }

    public function update(Vehicle $vehicle)
    {
        $statement = $this->pdo->prepare('
        UPDATE vehicles
        SET type = :type, url = :url, visible = :visible, sold = :sold,
            price = :price, meta_keywords = :meta_keywords,
            meta_desc = :meta_desc, page_title = :page_title, modified = NOW()
        WHERE vehicle_id = :vehicle_id
        ');
        $data = $this->hydrator->extract($vehicle);
        $statement->bindValue(':type', $data['type'], \PDO::PARAM_STR);
        $statement->bindValue(':url', $data['url'], \PDO::PARAM_STR);
        $statement->bindValue(':visible', $data['visible'], \PDO::PARAM_INT);
        $statement->bindValue(':sold', $data['sold'], \PDO::PARAM_INT);
        $statement->bindValue(':price', $data['price'], \PDO::PARAM_INT);
        $statement->bindValue(':meta_keywords', $data['meta_keywords'], \PDO::PARAM_STR);
        $statement->bindValue(':meta_desc', $data['meta_desc'], \PDO::PARAM_STR);
        $statement->bindValue(':page_title', $data['page_title'], \PDO::PARAM_STR);
        $statement->bindValue(':vehicle_id', $data['vehicle_id'], \PDO::PARAM_INT);
        $statement->execute();
    }
}
