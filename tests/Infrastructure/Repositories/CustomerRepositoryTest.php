<?php

use App\DomainDrivenDesign\Infrastructure\Repositories\Pdo\CustomerRepository;
use App\DomainDrivenDesign\Domain\Customer\Exceptions\CustomerNotFoundException;
use App\DomainDrivenDesign\Domain\Customer\Repositories\CustomerRepositoryInterface;

it('should returns if it is an instance', fn() => expect(new CustomerRepository)->toBeInstanceOf(CustomerRepositoryInterface::class));
it('should returns if have a methods', fn() => expect(new CustomerRepository)->toHaveMethods(['create', 'update', 'delete', 'findById', 'findAll']));

describe('Customer Repository unit tests', function() {
    it('should create a customer', function() {
        $data = [
            'name' => 'Jonathan Xavier Ribeiro', 
            'address' => [
                'street' => 'Rua 1', 
                'number' => 10, 
                'zipcode' => '07110010', 
                'city' => 'São Paulo', 
                'state' => 'SP'
            ], 
            'active' => true
        ];
        $customerRepository = new CustomerRepository();
        $created = $customerRepository->create($data);

        expect($created)->toBeObject();
        expect($created->name)->toEqual($data['name']);
        expect($created->active)->toEqual($data['active']);
    });

    it('should update a customer', function() {
        $customerRepository = new CustomerRepository();

        $dataCreated = [
            'name' => 'Jonathan Xavier Ribeiro', 
            'address' => [
                'street' => 'Rua 1', 
                'number' => 10, 
                'zipcode' => '07110010', 
                'city' => 'São Paulo', 
                'state' => 'SP'
            ], 
            'active' => true
        ];        
        $created = $customerRepository->create($dataCreated);

        $data = [
            'name' => 'Jonathan Xavier', 
            'address' => [
                'street' => 'Rua 2', 
                'number' => 10, 
                'zipcode' => '07110010', 
                'city' => 'São Paulo', 
                'state' => 'SP'
            ], 
            'active' => true
        ];
        $updated = $customerRepository->update($data, $created->id);

        expect($updated)->toBeObject();
        expect($updated->name)->toEqual($data['name']);
        expect($updated->address->street)->toEqual($data['address']['street']);
    });

    it('should delete a customer', function() {
        $customerRepository = new CustomerRepository();

        $dataCreated = [
            'name' => 'Jonathan Xavier Ribeiro', 
            'address' => [
                'street' => 'Rua 1', 
                'number' => 10, 
                'zipcode' => '07110010', 
                'city' => 'São Paulo', 
                'state' => 'SP'
            ], 
            'active' => true
        ];       
        $created = $customerRepository->create($dataCreated);
        $deleted = $customerRepository->delete($created->id);
        
        expect($deleted)->toBeTrue();
    });    

    it('should find a customer', function() {
        $customerRepository = new CustomerRepository();

        $dataCreated = [
            'name' => 'Jonathan Xavier Ribeiro', 
            'address' => [
                'street' => 'Rua 1', 
                'number' => 10, 
                'zipcode' => '07110010', 
                'city' => 'São Paulo', 
                'state' => 'SP'
            ], 
            'active' => true
        ];         
        $created = $customerRepository->create($dataCreated);

        $find = $customerRepository->findById($created->id);

        expect($find)->toBeObject();
        expect($find->name)->toEqual($dataCreated['name']);
        expect($find->active)->toEqual($dataCreated['active']);
    });

    it('should find all a customer', function() {
        $customerRepository = new CustomerRepository();
        $dataCreated = [
            'name' => 'Jonathan Xavier Ribeiro', 
            'address' => [
                'street' => 'Rua 1', 
                'number' => 10, 
                'zipcode' => '07110010', 
                'city' => 'São Paulo', 
                'state' => 'SP'
            ], 
            'active' => true
        ]; 
        $customerRepository->create($dataCreated);

        $findAll = $customerRepository->findAll();

        expect($findAll)->toBeObject();
    });
});
