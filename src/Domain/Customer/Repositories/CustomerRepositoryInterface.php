<?php

namespace App\DomainDrivenDesign\Domain\Customer\Repositories;

interface CustomerRepositoryInterface
{
    public function create(array $data): object;
    public function update(array $data, int $id): object;
    public function delete(int $id): bool;
    public function findById(int $id): object;
    public function findAll(): object;
}