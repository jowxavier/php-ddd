<?php

namespace App\DomainDrivenDesign\Domain\Customer\Repositories;

interface CustomerRepositoryInterface
{
    public function create(array $data): void;
    public function update(array $data, int $id): void;
    public function delete(int $id): void;
    public function findById(int $id): object;
    public function findAll(): object;
}