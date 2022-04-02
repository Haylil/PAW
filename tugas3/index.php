<?php
	//koneksi database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database ="perpustakaan";

	$koneksi= mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	//simpan
	if(isset($_POST['bsimpan']))
	{
		//pengujian simpan baru atau edit
		if($_GET['hal'] == "edit"){
			//data diedit disimpan
			$edit = mysqli_query($koneksi," UPDATE data_buku set 
												id_buku = '$_POST[bid]',
												kategori = '$_POST[bkategori]',
												judul = '$_POST[bjudul]', 
												penulis = '$_POST[bpenulis]',
												penerbit = '$_POST[bpenerbit]',
												tahun_terbit = '$_POST[btahun]'
											WHERE id_buku = '$_GET[id]'

			");

			//simpan data
			if($edit)
			{
				echo "<script>
					alert('edit data sukses!');
					document.location='index.php';
				</script>";
			}
			else
			{
				echo"<script>
					alert('edit data gagal!');
					document.location='index.php';
				</script>";
			}

		}else{
			//data baru disimpan
			$simpan = mysqli_query($koneksi,"INSERT INTO data_buku 
													(id_buku,
													kategori, 
													judul, 
													penulis, 
													penerbit, 
													tahun_terbit) 
										VALUES ('$_POST[bid]',
												'$_POST[bkategori]',
												'$_POST[bjudul]',
												'$_POST[bpenulis]',
												'$_POST[bpenerbit]', 
												'$_POST[btahun]')
			");

			//simpan data
			if($simpan)
			{
				echo "<script>
					alert('simpan data sukses!');
					document.location='index.php';
				</script>";
			}
			else
			{
				echo"<script>
					alert('simpan data gagal!');
					document.location='index.php';
				</script>";
			}
		}
		
	}

	//edit data
	if(isset($_GET['hal'])){

		//pengujian jika edit data
		if($_GET['hal'] == "edit"){
			//tampilkan data yang akan diedit
			$tampil = mysqli_query($koneksi,"SELECT * FROM data_buku WHERE id_buku= '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data){
				//data ditampung dalam variabel
				$vnim = $data['id_buku'];
				$vkategori = $data['kategori'];
				$vjudul = $data['judul'];
				$vpenulis = $data['penulis'];
				$vpenerbit = $data['penerbit'];
				$vtahun = $data['tahun_terbit'];
			}
		}
		else if ($_GET['hal'] =="hapus"){
			//menghapus
			$hapus = mysqli_query($koneksi, "DELETE FROM data_buku WHERE id_buku = '$_GET[id]'");
			if($hapus)
			{
				echo "<script>
					alert('hapus data sukses!');
					document.location='index.php';
				</script>";
			}
			else
			{
				echo"<script>
					alert('hapus data gagal!');
					document.location='index.php';
				</script>";
			}
		}
	}
?>






<!DOCTYPE html>
<html>
<head>
	<title>PERPUSTAKAAN</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="text-center">WEBSITE PERPUSTAKAAN</h1> 

	<!-- awal card form -->
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    FORM INPUT BUKU
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>ID Buku</label>
	    		<input type="text" name="bid" value="<?=@$vnim?>" class="form-control" placeholder="Masukkan ID Buku" required="">
	    	</div>
	    	<div class="form-group">
	    		<label>Kategori Buku</label>
	    		<select class="form-control" name="bkategori">
	    			<option value="<?=@$vkategori?>"><?=@$vkategori?></option>
	    		 	<option value="umum">UMUM</option>
	    			<option value="filsafat">FILSAFAT</option>
	    			<option value="psikologi">PSIKOLOGI</option>
	    			<option value="agama">AGAMA</option>
	    			<option value="sosial">SOSIAL</option>
	    			<option value="bahasa">BAHASA</option>
	    			<option value="sains">SAINS</option>
	    			<option value="matematika">MATEMATIKA</option>
	    			<option value="teknologi">TEKNOLOGI</option>
	    			<option value="sejarah">SEJARAH</option>
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label>Judul Buku</label>
	    		<input type="text" name="bjudul" value="<?=@$vjudul?>" class="form-control" placeholder="Masukkan Judul Buku" required="">
	    	</div>
	    	<div class="form-group">
	    		<label>Nama Penulis Buku</label>
	    		<input type="text" name="bpenulis" value="<?=@$vpenulis?>" class="form-control" placeholder="Masukkan Nama Penulis Buku" required="">
	    	</div>
	    	<div class="form-group">
	    		<label>Penerbit Buku</label>
	    		<input type="text" name="bpenerbit" value="<?=@$vpenerbit?>" class="form-control" placeholder="Masukkan Nama Penerbit Buku" required="">
	    	</div>
	    	<div class="form-group">
	    		<label>Tahun Terbit Buku</label>
	    		<input type="text" name="btahun" value="<?=@$vtahun?>"class="form-control" placeholder="Masukkan Tahun Terbit Buku" required="">
	    	</div>
	    	<button type="submit" class="btn btn-success" name="bsimpan">SIMPAN</button>
	    	<button type="reset" class="btn btn-danger" name="briset">KOSONGKAN</button>
	    </form>
	  </div>
	</div>
	<!-- end card -->

	<!-- awal card table -->
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    DAFTAR BUKU
	  </div>
	  <div class="card-body">
	    <table class="table table-bordered table-striped">
	    	<tr>
	    		<th>ID BUKU</th>
	    		<th>KATEGORI</th>
	    		<th>JUDUL BUKU</th>
	    		<th>PENULIS</th>
	    		<th>PENERBIT</th>
	    		<th>TAHUN TERBIT</th>
	    		<th>AKSI</th>
	    	</tr>
	    	<?php
	    		$tampil =mysqli_query($koneksi, "SELECT *from data_buku order by id_buku desc");
	    		while($data = mysqli_fetch_array($tampil)):
	    	?>
	    	<tr>
	    		<td><?=$data['id_buku']?></td>
	    		<td><?=$data['kategori']?></td>
	    		<td><?=$data['judul']?></td>
	    		<td><?=$data['penulis']?></td>
	    		<td><?=$data['penerbit']?></td>
	    		<td><?=$data['tahun_terbit']?></td>
	    		<td>
	    			<a href="index.php?hal=edit&id=<?=$data['id_buku']?>" class="btn btn-warning"> Edit</a>
	    			<a href="index.php?hal=hapus&id=<?=$data['id_buku']?>" onclick= "return confirm('Apakah yakin ingin menghapus data ini?')"
	    			class="btn btn-danger"> Hapus</a>
	    		</td>
	    	</tr>
	    	<?php endwhile; //penutup perulangan while ?> 
	    </table>
	  </div>
	</div>
	<!-- end card table -->
</div> 







<script type="text/javascript" src="bootstrap.min.js"></script>
</body>
</html>