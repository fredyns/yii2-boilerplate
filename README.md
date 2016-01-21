Yii 2 Boilerplate
===============================

Yii 2 Boilerplate adalah template & contoh aplikasi CRUD sederhana
dibuat dengan [Yii 2 Advanced Template](https://github.com/yiisoft/yii2-app-advanced/).

Didalamnya ada pengelolaan data wilayah Indonesia. Provinsi, Kota, Kecamatan dan Kelurahan.
Data diambil dari [db-daerah](https://github.com/cahyadsn/daerah).

Ditambah lagi dengan pengaturan hak akses tiap modelnya.



PROSES INSTALASI

langsung saja buka projectnya di GitHub. lalu langkahnya sbb:

1. clone repo

2. install komponen
```
composer install
```

3. memulai project Yii
```
./yii init
```

4. Buat Database

5. Set database connetion di file common/config/main-local.php

6. migrasi database
```
./yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
```

7. buka file database/model.mwb dgn Workbench lalu sinkronkan dengan mysql

8. Impor data secara urut
```
	a. region_country.sql
	b. region_province.sql
	c. region_city.sql
	d. region_district.sql
	e. region_subdistrict.sql
```