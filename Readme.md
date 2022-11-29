# QuasiQuiz - API

Backend de l'application QuasiQuiz, construit avec Symfony 6.1, PHP 8.1, ApiPlatform 3.0

## Installation

Clone le repo puis

```bash
  composer update
```

```bash
  symfony console doctrine:database:create
```

```bash
  symfony console doctrine:migration:migrate
```

```bash
  symfony console doctrine:fixtures:load
```

Pour consulter la documentation et les routes de l'API :

```bash
symfony serve -d
```

puis se rendre sur [localhost:8000](https://localhost:8000)

![ScreenAPI](/Docs/ScreenApi.png)

## Authors

- [@MateoLDC](https://www.github.com/MateoLDC)
- [@Hugo-Latreille](https://www.github.com/Hugo-Latreille)
