<?php

namespace App\DomainDrivenDesign\Infrastructure\Repositories\Pdo;

use PDO;
use PDOException;
use App\DomainDrivenDesign\Domain\Customer\Entities\Customer;
use App\DomainDrivenDesign\Domain\Customer\ValueObjects\Address;
use App\DomainDrivenDesign\Infrastructure\Database\PdoConnection;
use App\DomainDrivenDesign\Domain\Customer\Exceptions\CustomerNotFoundException;
use App\DomainDrivenDesign\Domain\Customer\Repositories\CustomerRepositoryInterface;

final class CustomerRepository extends PdoConnection implements CustomerRepositoryInterface
{
    public function create(array $data): object
    {  
        try {
            $this->pdo->beginTransaction();

            $queryAddress = $this->pdo->prepare(
                "INSERT INTO `addresses` (`street`, `number`, `zipcode`, `city`, `state`) VALUES (:street, :number, :zipcode, :city, :state)"
            );

            $queryAddress->bindParam(':street', $data['address']['street'], PDO::PARAM_STR);       
            $queryAddress->bindParam(':number', $data['address']['number'], PDO::PARAM_INT); 
            $queryAddress->bindParam(':zipcode', $data['address']['zipcode'], PDO::PARAM_STR);
            $queryAddress->bindParam(':city', $data['address']['city'], PDO::PARAM_STR);
            $queryAddress->bindParam(':state', $data['address']['state'], PDO::PARAM_STR);
            $queryAddress->execute();
            $addressId = $this->pdo->lastInsertId();        
            
            $query = $this->pdo->prepare(
                "INSERT INTO `customers` (`name`, `address_id`, `active`) VALUES (:name, :address_id, :active)"
            );

            $query->bindParam(':name', $data['name'], PDO::PARAM_STR);       
            $query->bindParam(':address_id', $addressId, PDO::PARAM_INT); 
            $query->bindParam(':active', $data['active'], PDO::PARAM_STR);
            $query->execute();
            $customerId = $this->pdo->lastInsertId();

            $this->pdo->commit();

            return $this->findById($customerId);
        } catch(PDOException $e) {
            $this->pdo->rollback();
            
            echo "Error: " . $e->getMessage();
        }
    }

    public function update(array $data, int $id): object
    {
        try {
            $this->pdo->beginTransaction();

            $customer = $this->findById($id);
            $addressId = $customer->address->id;

            $queryAddress = $this->pdo->prepare(
                "
                    UPDATE `addresses` 
                    SET 
                        `street` = :street, 
                        `number` = :number, 
                        `zipcode` = :zipcode, 
                        `city` = :city, 
                        `state` = :state 
                    WHERE `id` = :id
                "
            );

            $queryAddress->bindParam(':street', $data['address']['street'], PDO::PARAM_STR);       
            $queryAddress->bindParam(':number', $data['address']['number'], PDO::PARAM_INT); 
            $queryAddress->bindParam(':zipcode', $data['address']['zipcode'], PDO::PARAM_STR);
            $queryAddress->bindParam(':city', $data['address']['city'], PDO::PARAM_STR);
            $queryAddress->bindParam(':state', $data['address']['state'], PDO::PARAM_STR);
            $queryAddress->bindParam(':id', $addressId, PDO::PARAM_INT);
            $queryAddress->execute();

            $query = $this->pdo->prepare(
                "UPDATE `customers` SET `name` = :name, `address_id` = :address_id, `active` = :active WHERE `id` = :id"
            );

            $query->bindParam(':name', $data['name'], PDO::PARAM_STR);       
            $query->bindParam(':address_id', $addressId, PDO::PARAM_INT); 
            $query->bindParam(':active', $data['active'], PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();             

            $this->pdo->commit();

            return $this->findById($id);
        } catch(PDOException $e) {
            $this->pdo->rollback();
            
            echo "Error: " . $e->getMessage();
        }
    }

    public function delete(int $id): bool
    {
        try {
            $this->pdo->beginTransaction();

            $customer = $this->findById($id);
            $addressId = $customer->address->id;

            $queryAddress = $this->pdo->prepare(
                "DELETE FROM `addresses` WHERE id = :id"
            );

            $queryAddress->bindParam(':id', $addressId, PDO::PARAM_INT);
            $queryAddress->execute();

            $query = $this->pdo->prepare(
                "DELETE FROM `customers` WHERE `id` = :id"
            );

            $query->bindParam(':id', $id, PDO::PARAM_INT);

            $this->pdo->commit();

            return $query->execute();
        } catch(PDOException $e) {
            $this->pdo->rollback();
            
            echo "Error: " . $e->getMessage();
        }
    }

    public function findById(int $id): object 
    {
        $query = $this->pdo->prepare(
            "
                SELECT 
                    `customers`.`id`, 
                    `customers`.`name`, 
                    `customers`.`active`, 
                    `addresses`.`id` AS address_id,
                    `addresses`.`street`,
                    `addresses`.`number`,
                    `addresses`.`zipcode`,
                    `addresses`.`city`,
                    `addresses`.`state`
                FROM `customers` 
                INNER JOIN `addresses` ON `customers`.`address_id` = `addresses`.`id` 
                WHERE `customers`.`id` = :id
            "
        );

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $record = $query->fetch(PDO::FETCH_OBJ);

        if (!$record) {
            throw new CustomerNotFoundException($id);
        }

        $customer = new Customer();
        $customer->id = $record->id;
        $customer->name = $record->name;
        $customer->address = new Address($record->address_id, $record->street, $record->number, $record->zipcode, $record->city, $record->state);
        $customer->activate();

        return $customer;
    }

    public function findAll(): object 
    {
        $query = $this->pdo->prepare(
            "
                SELECT 
                    `customers`.`id`, 
                    `customers`.`name`, 
                    `customers`.`active`, 
                    `addresses`.`id` AS address_id,
                    `addresses`.`street`,
                    `addresses`.`number`,
                    `addresses`.`zipcode`,
                    `addresses`.`city`,
                    `addresses`.`state`
                FROM `customers` 
                INNER JOIN `addresses` ON `customers`.`address_id` = `addresses`.`id`
            "
        );
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }
}

