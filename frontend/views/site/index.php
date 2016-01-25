<?php

/* @var $this yii\web\View */

$this->title = 'Yii 2 Boilerplate';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Yii 2 Boilerplate</h1>

        <p class="lead">Template aplikasi dengan Framework Yii 2. Dilengkapi dengan database wilayah indonesia.</p>

        <p><a class="btn btn-lg btn-success" href="http://github.com/fredyns/yii2-boilerplate">GitHub Project</a></p>
    </div>

    <div class="body-content">

		Hallo sanak famili,
		<p style="text-align: justify;">Kali ini saya lagi main-main dengan framework Yii2. Sebelumnya saya berkutat dengan framework CodeIgniter, sudah waktunya nyoba sesuatu yang lain.</p>
		<p style="text-align: justify;">Yii ini keren. Canggih, fitur jg banyak. Tapi tidak terlalu rumit dipelajari. Entah kenapa saya lagi males <em>tenggelam</em> dengan teknis koding yang rumit. Lebih baik fokus merancang solusi bagi permasalahan pengguna. Karna akhirnya pengguna tidak terlalu perduli dengan blink-blink teknologi baru pemrograman.</p>
		<p style="text-align: justify;">Oke, fokus!
			sebagai pembuka saya tidak akan membuat project yg rumit. Cukup CRUD dasar saja sambil menyesuaikan alur coding berdasarkan pengalaman yg sudah didapat. Jadi saya memutuskan untuk membuat Yii2-Boilerplate, satu aplikasi sederhana berisi master data yg umum digunakan. Sehingga bisa jadi dasar project-project lainnya.</p>
		<p style="text-align: justify;">Harapannya ini bisa jadi media belajar bersama untuk membuat web/aplikasi menggunakan framework Yii2.</p>
		<p style="text-align: justify;"><a href="https://github.com/fredyns/yii2-boilerplate" target="_blank"><strong>Yii2-Boilerplate</strong></a> ini berisi:</p>
		<p style="text-align: justify;"><!--more--></p>

		<ul>
			<li style="text-align: justify;"><a href="https://github.com/yiisoft/yii2-app-advanced" target="_blank"><strong>Yii2-app-advance</strong></a>
				Template aplikasi advance untuk framework Yii2. Di dalamnya sudah ada pembagian aplikasi untuk frontend, backend &amp; console. Jadi bisa dipisah antara sistem khusus admin &amp; pengguna.</li>
			<li style="text-align: justify;"><a href="https://github.com/dmstr/yii2-adminlte-asset" target="_blank"><strong>adminLTE</strong></a>
				Template tampilan yg cantik. Responsive, support untuk mobile browser. Contohnya tampilannya bisa dilihat <a href="https://almsaeedstudio.com/preview" target="_blank">disini</a>.</li>
			<li style="text-align: justify;">Database wilayah Indonesia
				Dari 34 propinsi, kota, kecamatan hingga kelurahan. Datanya saya ambil datanya dari project GitHub <a href="https://github.com/cahyadsn/daerah" target="_blank">database daerah</a>. Terimakasih untuk master <a href="https://www.facebook.com/cahya.dsn" target="_blank">Cahya</a>. Dilengkapi juga dengan google map untuk setiap wilayahnya. Data disesuaikan dengan Permendagri no 39 tahun 2015. Bisa dibilang project ini versi Yii2-nya dari saya. Bedaya paling Primary-Key saya ganti pake autonumber dgn tetap menyimpan nomor daerah sesuai permendagri. Saya penganut system generated key :D</li>
			<li style="text-align: justify;">Tambahan pribadi
				Dari saya ada beberapa class tapi yg utama ada access control untuk tiap model dan contoh module di front end. Database daerah dikelola dgn 2 cara, pertama controller langsung di frontend-controller dan kedua module terpisah. Isinya sama saja. Hanya untuk menegaskan perbedaan kalo buat komponen yang saling bercampur dengan module yg mencakup fitur tertentu.</li>
		</ul>
		&nbsp;

		<strong>Tambahan Pribadi</strong>

		Dari saya ada bebera class, fungsi serta extend dari komponen bawaan. Tapi yg utama ada 2, yaitu:

		1. Access Control tiap Model
		<p style="text-align: justify;">Saya tidak biasa pake RBAC untuk mengontrol hak akses pengguna berdasarkan tipenya. Yang biasa saya lakukan hak aksesnya diatur berdasarkan kaitan dirinya terhadap model. Misalnya gini: yang bisa edit nilai siswa adalah guru pelajaran terkait. Berarti hak aksesnya guru tertentu, pelajaran tertentu untuk sekelompok siswa tertentu. Entah apa istilahnya kalo di dunia programing dan juga penerapannya. Hal ini masih jarang dibahas serta disediakan tutorialnya.</p>
		<p style="text-align: justify;">Hal ini menarik karena proses pengecekkannya bisa jadi sangat rumit, sedang sangat dibutuhkan di beberapa sisi sistem. Misal gini, saat menampilkan detail suatu data pasti akan dimunculkan beberapa button untuk operasi data tersebut. Misalkan <em>Update</em>. Nah, ketika masuk form update tersebut harus di-cek lagi di controller, perintah ini valid &amp; boleh dijalankan atau tidak. Sesuai user yg sedang login.</p>
		<p style="text-align: justify;">Klo code pengecekannya selalu disebutin satu-persatu tiap halaman akan merepotkan. Dan rentan error ketika terjadi perubahan. Oleh karena itu perlu dibuat class sendiri untuk fungsi ini. Klo butuh tinggal dipanggil, klo berubah cukup edit di satu tempat. Class ini jadi satu dengan button generator operasi data. Jadi tiap kali load model sudah ada daftar operasi yg bisa dilakukan serta link/button yg tersedia.</p>
		<p style="text-align: justify;">Fitur ini terbagi jadi 2 tipe class extend dari <strong>ModelAccess</strong> dan <strong>ModelOperation</strong>. ModelAccess untuk mengatur hak akses ke model seperti menampilkan tabel data &amp; create data baru. Sedang ModelOperation mengelola operasi apa saja yg tersedia untuk suatu model.</p>
		&nbsp;

		2. Module Database Daerah
		<p style="text-align: justify;">Ini adalah implementasi data wilayah indonesia. Untuk mengelola data ini disediakan modul tersendiri (frontend) dan juga controller frontend. Sebenarnya isinya sama saja. Module ini dibuat hanya sebagai contoh untuk menunjukan perbedaan komponen yg dikelompokkan tersendiri dalam satu module dengan komponen yg bercampur jadi satu di frontend. Secara coding sih lebih rapi tentunya. Satu-satunya yg terasa agak gimana cuma penyebutan namespace. Itupun hanya sedikit saat deklarasi class &amp; use class.</p>
		&nbsp;

		<strong>Proses Instalasi</strong>

		langsung saja buka projectnya di <a href="https://github.com/fredyns/yii2-boilerplate" target="_blank">GitHub</a>. lalu langkahnya sbb:

		1. clone repo
		bisa download zip, via git client atau <a href="http://fredyns.net/blog/2016/01/clone-github-project-via-netbeans/" target="_blank">menggunakan NetBeans</a>.

		2. install komponen via <a href="https://getcomposer.org/" target="_blank">composer</a>
		buka terminal. masuk ke folder project. ketikan perintah :
		<pre class="brush: shell; gutter: true">composer install</pre>
		3. memulai project Yii
		masih di terminal. ketik perintah:
		<pre class="brush: shell; gutter: true">./yii init</pre>
		<p style="text-align: justify;">bila di linux pastikan file "yii" bisa dieksekusi. Pilih environtment. Klo bingung pilih aja 'development' (masih dalam pengembangan)</p>
		4. Buat Database
		masuk mysql/phpmyadmin, lalu buat database untuk sistem.
		<p style="text-align: justify;">5. Set database connetion
			edit file <span style="color: #0000ff;">common/config/main-local.php</span>. ubah parameter koneksi database yg tertera disitu sesuai konfigurasi mysql Kamu.</p>
		6. migrasi database
		kembali ke terminal untuk setup tabel sistem di database. ketikan perintah berikut:
		<pre class="brush: shell; gutter: true">./yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations</pre>
		di boilerplate ini pake user management <span style="color: #0000ff;">dektrium/yii2-user</span>.

		sampai sini harusnya sistem sudah bisa diakses lewat browser.
		<p style="text-align: justify;">7. Setup tabel lainnya
			Biar ringkas saya sarankan pake <a href="https://dev.mysql.com/downloads/workbench/" target="_blank">Workbench</a> , tak ada migration. Buka saja filenya <span style="color: #0000ff;">database/model.mwb</span> lalu sinkronkan dengan mysql kamu. Nama databasenya diatur sesuai yg dibuat tadi. Nanti struktur tabel di workbench bakal pindah ke mysql.
			Kalau tak ada workbench, saya sediakan changelog sql yg bisa diimpor ke mysql di folder <span style="color: #0000ff;">database/changelog</span>. impor saja sesuai urutan.</p>
		8. Impor data
		database wilayah indonesia tersedia di folder <span style="color: #0000ff;">database/dump</span>. Diimpor ke mysql urut dari file:
		<p style="padding-left: 60px;">1. region_country.sql
			2. region_province.sql
			3. region_city.sql
			4. region_district.sql
			5. region_subdistrict.sql</p>
		<p style="text-align: justify;">harus urut karena ada constrain relasi tabel. jadi harus urut dr negara lalu turun sampai kelurahan.</p>
		<p style="text-align: justify;">Selesai!
			coba cek lewat browser. eksplor semua menu yg tersedia di panel kiri .
			contoh yg sudah jadi ada <a href="http://goo.gl/RoGYTv" target="_blank">disini</a>.</p>
		<p style="text-align: justify;">Selamat mencoba, semoga bermanfaat.
			nanti klo ada update saya kabari lagi.
			Jangan sungkan untuk komen ya.
			:)</p>
    </div>
</div>
