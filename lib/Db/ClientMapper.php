<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: Stefan Petersen <stefan@openelp.de>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\ClientManager\Db;

use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\Entity;
use OCP\AppFramework\Db\QBMapper;
use OCP\DB\QueryBuilder\IQueryBuilder;
use OCP\IDBConnection;

/**
 * @template-extends QBMapper<Note>
 */
class ClientMapper extends QBMapper {
	public function __construct(IDBConnection $db) {
		parent::__construct($db, 'clientmanager', Client::class);
	}

	/**
	 * @throws \OCP\AppFramework\Db\MultipleObjectsReturnedException
	 * @throws DoesNotExistException
	 */
	public function find(int $id, string $userId): Client {
		/* @var $qb IQueryBuilder */
		$qb = $this->db->getQueryBuilder();
		$qb->select('*')
			->from('clientmanager')
			->where($qb->expr()->eq('id', $qb->createNamedParameter($id, IQueryBuilder::PARAM_INT)))
			->andWhere($qb->expr()->eq('id', $qb->createNamedParameter($Id)));
		return $this->findEntity($qb);
	}

	/**
	 * @param string $userId
	 * @return array
	 */
	public function findAll(string $userId): array {
		// /* @var $qb IQueryBuilder */
		// $qb = $this->db->getQueryBuilder();
		// $qb->select('*')
		// 	->from('clientmanager');
		// 	//->where($qb->expr()->eq('user_id', $qb->createNamedParameter($userId)));
		// return $this->findEntities($qb);

		
		$returnValue = array();

		for ($i=0; $i < 10; $i++) { 
			$client = new Client();
			$client->setId($i);
			$client->setName('Name '.$i);
			$client->setContent('Testcontent');

			array_push($returnValue, $client);
		}		

		return $returnValue;
	}
}
