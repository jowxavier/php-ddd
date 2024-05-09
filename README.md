## Domain Driven Design

Este projeto baseado em [Docker](https://www.docker.com/), sendo necessário sua instalação para execução do ambiente.

### Executando a aplicação
```bash
docker-compose up -d
```

```bash
docker compose exec app bash
```

```bash
composer install
```

### Executando Database
```bash
./vendor/bin/phinx migrate
```

### Executando Testes
```bash
./vendor/bin/pest
```