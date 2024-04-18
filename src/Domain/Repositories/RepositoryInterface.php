<?php

namespace App\DomainDrivenDesign\Domain\Repositories;

interface RepositoryInterface
{
    public function create(array $data): void;
    public function update(array $data, int $id): void;
    public function delete(int $id): void;
    public function findById(int $id): object;
    public function findAll(): array;
}