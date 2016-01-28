<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Yii 2 Boilerplate';

?>
<style>
	dd {
		margin-bottom: 30px;
	}
	dt {
		margin-top: 20px;
	}

</style>
<div class="site-index">

	<div
		class="fb-like"
		data-share="true"
		data-width="450"
		data-show-faces="true"
		style="float: right;"
		>
	</div>

    <div class="jumbotron">
        <h1>Yii 2 Boilerplate</h1>

        <p class="lead">Template aplikasi dengan Framework Yii 2. Dilengkapi dengan database wilayah indonesia.</p>

        <p>
			<a class="btn btn-lg btn-success" href="http://github.com/fredyns/yii2-boilerplate">GitHub Project</a>
			<a class="btn btn-lg btn-primary" href="http://fredyns.net/blog/2016/01/yii2-boilerplate/">Blog Post</a>
		</p>

    </div>

    <div class="body-content">

		<?php if (Yii::$app->user->isGuest): ?>

			<p align="center">
				Silahkan login/register dulu untuk melihat fitur lainnya. Gratis kok.
				Untuk demo fitur user management.
			</p>

			<p align="center">
				<?= Html::a('Login', ['/user/security/login'], ['class' => 'btn btn-lg btn-info', 'title' => 'masuk ke sistem']) ?>
				&nbsp;
				<?= Html::a('Lupa Password', ['/user/recovery/request'], ['class' => 'btn btn-lg btn-warning', 'title' => 'reset password']) ?>
			</p>

			<p align="center">
				<?= Html::a('Register', ['/user/registration/register'], ['class' => 'btn btn-lg btn-info', 'title' => 'mendaftarkan akun baru']) ?>
				&nbsp;
				<?= Html::a('Resend Confirmation', ['/user/registration/resend'], ['class' => 'btn btn-lg btn-info', 'title' => 'kirim ulang email konfirmasi akun']) ?>
			</p>

		<?php else: ?>

			Welcome :)
			<br/>

			<p style="text-align: justify;">
				<a href="https://github.com/fredyns/yii2-boilerplate" target="_blank"><strong>Yii2-Boilerplate</strong></a> ini berisi:
			</p>

			<ul>
				<li style="text-align: justify;">
					<a href="https://github.com/yiisoft/yii2-app-advanced" target="_blank"><strong>Yii2-app-advance</strong></a>
				</li>
				<li style="text-align: justify;">
					<a href="https://github.com/dektrium/yii2-user" target="_blank"><strong>Dektrium User Management</strong></a>
				</li>
				<li style="text-align: justify;">
					<a href="https://github.com/dmstr/yii2-adminlte-asset" target="_blank"><strong>adminLTE</strong></a>
				</li>
				<li style="text-align: justify;">
					<a href="https://github.com/cahyadsn/daerah" target="_blank">Database wilayah Indonesia</a>.
				</li>
			</ul>
			&nbsp;

			<strong>Tambahan Pribadi</strong>

			Dari saya ada bebera class, fungsi serta extend dari komponen bawaan. Tapi yg utama ada 2, yaitu:

			<dl>

				<dt>1. Access Control tiap Model</dt>
				<dd>disiapkan class untuk mengatur akses ke model, operasi yg tersedia untuk model serta link generatornya.</dd>

				<dt>2. Module Database Daerah</dt>
				<dd>biar tau aja bedanya komponen yg ditulis langsung di bawah frontend dan dikelompokkan dalam module.</dd>

			</dl>

			<p style="text-align: justify;">
				Proses instalasi bisa lihat di
				<a href="goo.gl/U1jZs6" target="_blank"><strong>blog ini</strong></a>.
			</p>

			<p style="text-align: justify;">
				Selamat mencoba, semoga bermanfaat.
				nanti klo ada update saya kabari lagi.
				Jangan sungkan untuk komen ya.
				:)
			</p>

			<!--
			<p>
				Klik menu di sebelah kiri untuk explore menu lainnya.
			</p>

			<strong>Proses Instalasi</strong>

			langsung saja buka projectnya di <a href="https://github.com/fredyns/yii2-boilerplate" target="_blank">GitHub</a>. lalu langkahnya sbb:

			<dl>

				<dt>1. clone repo</dt>
				<dd>
					bisa download zip, via git client atau <a href="http://fredyns.net/blog/2016/01/clone-github-project-via-netbeans/" target="_blank">menggunakan NetBeans</a>.
				</dd>

				<dt>
				2. install komponen via <a href="https://getcomposer.org/" target="_blank">composer</a>
				</dt>
				<dd>
					buka terminal. masuk ke folder project. ketikan perintah :
					<pre class="brush: shell; gutter: true">composer install</pre>
				</dd>

				<dt>3. memulai project Yii</dt>
				<dd>
					masih di terminal. ketik perintah:
					<pre class="brush: shell; gutter: true">./yii init</pre>
					<p style="text-align: justify;">bila di linux pastikan file "yii" bisa dieksekusi. Pilih environtment. Klo bingung pilih aja 'development' (masih dalam pengembangan)</p>
				</dd>

				<dt>4. Buat Database</dt>
				<dd>
					masuk mysql/phpmyadmin, lalu buat database untuk sistem.
				</dd>

				<dt>5. Set database connetion</dt>
				<dd>
					edit file <span style="color: #0000ff;">common/config/main-local.php</span>. ubah parameter koneksi database yg tertera disitu sesuai konfigurasi mysql Kamu.</p>
				</dd>

				<dt>6. migrasi database</dt>
				<dd>
					kembali ke terminal untuk setup tabel sistem di database. ketikan perintah berikut:
					<pre class="brush: shell; gutter: true">./yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations</pre>
					di boilerplate ini pake user management <span style="color: #0000ff;">dektrium/yii2-user</span>.

					sampai sini harusnya sistem sudah bisa diakses lewat browser.
				</dd>

				<dt>7. Setup tabel lainnya</dt>
				<dd>
					Biar ringkas saya sarankan pake <a href="https://dev.mysql.com/downloads/workbench/" target="_blank">Workbench</a> , tak ada migration. Buka saja filenya <span style="color: #0000ff;">database/model.mwb</span> lalu sinkronkan dengan mysql kamu. Nama databasenya diatur sesuai yg dibuat tadi. Nanti struktur tabel di workbench bakal pindah ke mysql.
					Kalau tak ada workbench, saya sediakan changelog sql yg bisa diimpor ke mysql di folder <span style="color: #0000ff;">database/changelog</span>. impor saja sesuai urutan.</p>
				</dd>

				<dt>8. Impor data</dt>
				<dd>
					database wilayah indonesia tersedia di folder <span style="color: #0000ff;">database/dump</span>. Diimpor ke mysql urut dari file:

					<ol>
						<li>region_country.sql</li>
						<li>region_province.sql</li>
						<li>region_city.sql</li>
						<li>region_district.sql</li>
						<li>region_subdistrict.sql</li>
					</ol>

					<p style="text-align: justify;">harus urut karena ada constrain relasi tabel. jadi harus urut dr negara lalu turun sampai kelurahan.</p>
				</dd>

			</dl>

			<p style="text-align: justify;">
				<b>Selesai!</b><br/>
				coba cek lewat browser. eksplor semua menu yg tersedia di panel kiri .
				contoh yg sudah jadi ada <a href="http://goo.gl/RoGYTv" target="_blank">disini</a>.
			</p>

			<p style="text-align: justify;">
				Selamat mencoba, semoga bermanfaat.
				nanti klo ada update saya kabari lagi.
				Jangan sungkan untuk komen ya.
				:)
			</p>
			-->

		<?php endif; ?>

    </div>
</div>

