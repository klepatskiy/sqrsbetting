# sqrsbetting

## start project
```shell
sudo ifconfig lo0 alias 22.22.2.2
```

```shell
make build
```
При желании можно замапить хост 22.22.2.2 в  /etc/host 
```
22.22.2.2 betting.local.com
```

## Разработка
каждый раз начинаем с конманды (миграции + генерация спеки)
```shell
make wakeapp
```
