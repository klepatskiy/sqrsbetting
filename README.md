# sqrsbetting

## start project
```shell
sudo ifconfig lo0 alias 33.33.3.3
```

```shell
make build
```
При желании можно замапить хост 33.33.3.3 в  /etc/host 
```
33.33.3.3 betting.local
```

## Разработка
каждый раз начинаем с конманды (миграции + генерация спеки)
```shell
make wakeapp
```
