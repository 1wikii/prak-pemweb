<?php
// NAMA  : Ahmad Dwiky Zerro Dixxon
// NIM   : 121140044
// KELAS : RB


if(!isset($_SESSION['nama'])){
   
   try{
      session_start();           // menggunakan Session agar data dapat didalam variable super global

      $_SESSION['nama'] = '';       // kenapa menggunakan session ?
      $_SESSION['nim'] = '';        // karena jika langsung menggunakan $_POST maka PBO akan sia-sia
      $_SESSION['prodi'] = '';      // karena data bisa saja langsung ditaruh di HTML 
      $_SESSION['umur'] = '';       // session bisa menyimpan data divariable superglobal selam session tidak di unset
      $_SESSION['alamat'] = '';     // data akan tetap ada

   }catch(Exception $e){            // menggunakan Exception untuk catch error apapun secara general
      die($e->getMessage());        // tidak menggunakan custom error seperti => throw new ()
   }
}

class bio{
   public $nama;
   public $nim;
   public $prodi;

   public function __construct($_nama, $_nim, $_prodi){
      $this->nama = $_nama;
      $this->nim = $_nim;
      $this->prodi = $_prodi;
   }

}

class biodata extends bio{
   public $umur;
   public $alamat;

   public function __construct($_nama, $_nim, $_prodi, $_umur, $_alamat){     
      parent::__construct($_nama, $_nim, $_prodi);                            // memanggil construct parent 
      $this->umur = $_umur;                                                   // agar hanya perlu instantiate child parent sudah include
      $this->alamat = $_alamat;

      $this->setData();
   }

   public function setData(){
      $_SESSION['nama'] = $this->nama;          // set isi dari session 
      $_SESSION['nim'] = $this->nim;
      $_SESSION['prodi'] = $this->prodi;
      $_SESSION['umur'] = $this->umur;
      $_SESSION['alamat'] = $this->alamat;
   }

}

if(isset($_POST['enter'])){
   $nama = $_POST['nama'];                   // mengambil data dari HTML
   $nim = $_POST['nim'];
   $prodi = $_POST['prodi'];
   $umur = $_POST['umur'];
   $alamat = $_POST['alamat'];

   try{
      
      $user = new biodata($nama, $nim, $prodi, $umur, $alamat);      // instantiate class

   }catch(Exception $e){                  // handling general error not spesific error
      die($e->getMessage());              // seperti penjelasan pada sebelumnya
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Data diri</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>
<body>
   
   <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">  <!--  action PHP_SELF maksudnya ada file ini sendiri -->
   <input type="text" name="nama" placeholder="Nama">
   <input type="text" name="nim" placeholder="NIM">
   <input type="text" name="prodi" placeholder="Prodi">
   <input type="text" name="umur" placeholder="Umur">
   <input type="text" name="alamat" placeholder="Alamat">


   <button type="submit" name="enter">Enter</button>

   </form>

   <table border="1">
      <tr>
         <td col="1">Nama</td>
         <td col="2">NIM</td>
         <td col="3">Prodi</td>
         <td col="4">Umur</td>
         <td col="5">Alamat</td>
      </tr>
      <tr>
         <td><?php echo $_SESSION['nama']; ?></td>  <!-- echo data session yang disimpan tadi -->
         <td><?php echo $_SESSION['nim']; ?></td>
         <td><?php echo $_SESSION['prodi']; ?></td>
         <td><?php echo $_SESSION['umur']; ?></td>
         <td><?php echo $_SESSION['alamat']; ?></td>
      </tr>
   </table>


</body>
</html>