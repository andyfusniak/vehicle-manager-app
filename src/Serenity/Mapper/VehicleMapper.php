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
        $stmt = $this->pdo->prepare(
            'INSERT INTO vehicles (vehicle_id, type, visible, sold, url, price, meta_keywords, meta_desc, page_title, markdown, page_html, created, modified) VALUES (null, :type, 1, 0, :url, :price, :meta_keywords, :meta_desc, :page_title, :markdown, :page_html, now(), now())'
        );

        $data = $this->hydrator->extract($vehicle);
        unset($data['vehicle_id']);
        unset($data['visible']);
        unset($data['sold']);
        unset($data['created']);
        unset($data['modified']);

        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }
}
