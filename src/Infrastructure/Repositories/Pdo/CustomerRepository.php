<?php

namespace App\DomainDrivenDesign\Infrastructure\Repositories\Pdo;

use PDO;
use App\DomainDrivenDesign\Domain\Customer\Entities\Customer;
use App\DomainDrivenDesign\Domain\Customer\ValueObjects\Address;
use App\DomainDrivenDesign\Infrastructure\Database\PdoConnection;
use App\DomainDrivenDesign\Domain\Customer\Exceptions\CustomerNotFoundException;
use App\DomainDrivenDesign\Domain\Customer\Repositories\CustomerRepositoryInterface;

final class CustomerRepository extends PdoConnection implements CustomerRepositoryInterface
{
    public function create(array $data): object
    {        
        $query = $this->pdo->prepare(
            "INSERT INTO `customers` (name, address_id, active) VALUES (:name, :address_id, :active)"
        );

        $query->bindParam(':name', $data['name'], PDO::PARAM_STR);       
        $query->bindParam(':address_id', $data['address_id'], PDO::PARAM_INT); 
        $query->bindParam(':active', $data['active'], PDO::PARAM_STR);
        $query->execute();

        return $this->findById($this->pdo->lastInsertId());
    }

    public function update(array $data, int $id): object
    {
        $query = $this->pdo->prepare(
            "UPDATE `customers` SET name = :name, address_id = :address_id, active = :active WHERE id = :id"
        );

        $query->bindParam(':name', $data['name'], PDO::PARAM_STR);       
        $query->bindParam(':address_id', $data['address_id'], PDO::PARAM_INT); 
        $query->bindParam(':active', $data['active'], PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();        

        return $this->findById($id);
    }

    public function delete(int $id): bool
    {
        $query = $this->pdo->prepare(
            "DELETE FROM `customers` WHERE id = :id"
        );

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }

    public function findById(int $id): object 
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM `customers` WHERE id = :id"
        );

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $record = $query->fetch(PDO::FETCH_OBJ);

        if (!$record) {
            throw new CustomerNotFoundException($id);
        }

        return $record;
    }

    public function findAll(): object 
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM `customers`"
        );
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }
}

