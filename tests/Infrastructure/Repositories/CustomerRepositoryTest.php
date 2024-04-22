<?php

use App\DomainDrivenDesign\Infrastructure\Repositories\Pdo\CustomerRepository;
use App\DomainDrivenDesign\Domain\Customer\Repositories\CustomerRepositoryInterface;

it('should returns if it is an instance', fn() => expect(new CustomerRepository)->toBeInstanceOf(CustomerRepositoryInterface::class));
it('should returns if have a methods', fn() => expect(new CustomerRepository)->toHaveMethods(['create', 'update', 'delete', 'findById', 'findAll']));

describe('Customer Repository unit tests', function() {
    it('should create a customer', function() {
        $data = ['name' => 'Jonathan Xavier Ribeiro', 'address_id' => 1, 'active' => true];
        $customerRepository = new CustomerRepository();
        $created = $customerRepository->create($data);

        expect($created)->toBeObject();
        expect($created)->toMatchObject($data);
    });

    it('should update a customer', function() {
        $customerRepository = new CustomerRepository();

        $dataCreated = ['name' => 'Jonathan Xavier Ribeiro', 'address_id' => 1, 'active' => true];        
        $created = $customerRepository->create($dataCreated);

        $dataUpdated = ['name' => 'Jonathan Xavier', 'address_id' => 1, 'active' => true];
        $updated = $customerRepository->update($dataUpdated, $created->id);

        expect($updated)->toBeObject();
        expect($updated)->toMatchObject($dataUpdated);
    });

    it('should delete a customer', function() {
        $customerRepository = new CustomerRepository();

        $dataCreated = ['name' => 'Jonathan Xavier Ribeiro', 'address_id' => 1, 'active' => true];       
        $created = $customerRepository->create($dataCreated);
        $customerRepository->delete($created->id);

        expect($dataCreated)->not->toBeObject();
    });

    it('should find a customer', function() {
        $customerRepository = new CustomerRepository();

        $dataCreated = ['name' => 'Jonathan Xavier Ribeiro', 'address_id' => 1, 'active' => true];        
        $created = $customerRepository->create($dataCreated);

        $find = $customerRepository->findById($created->id);

        expect($find)->toBeObject();
        expect($find)->toMatchObject($dataCreated);
    });

    it('should find all a customer', function() {
        $customerRepository = new CustomerRepository();

        $findAll = $customerRepository->findAll();

        expect($findAll)->toBeObject();
    });
});
