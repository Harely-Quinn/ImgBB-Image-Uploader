<?php
include "funcs.php";
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ImgBB</title>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Averia+Libre:wght@300&family=Pacifico&family=Roboto&display=swap">
    <link rel="stylesheet" href="dist/css/style.css">
  </head>
  <body class="bg-stone-200">
    <h1 class="font-pacifico text-sky-400 text-center text-5xl mt-6 mb-12 select-none">ImgBB</h1>
    
    <form class="flex justify-center" method="post" enctype="multipart/form-data">
      <div class="w-4/5 sm:w-3/5">
        <label for="input" class="block mx-auto w-full md:w-3/4 lg:w-32 py-2 bg-sky-700 text-center text-white rounded mb-5 hover:bg-sky-900">
          <i class="fas fa-upload"></i>
          <span class="text-white"> Select Image</span>
        </label>
        <input type="file" name="img" id="input" accept="image/*" class="hidden">
        <input type="submit" name="upload" class="block mx-auto py-2 px-6 bg-sky-600 border-2 text-white rounded-lg hover:bg-transparent hover:border-2 hover:border-sky-600 hover:text-sky-600 duration-300" value="Upload">
      </div>
    </form>
    
    <?php
    if(isset($_POST["upload"])) {
      $image = $_FILES["img"]["name"];
      $ext = pathinfo($image)["extension"];
      if(!in_array($ext, $allowedExt)) die("<img src='https://i.ibb.co/qr88h2Z/HFiigFg.png' width='200' height='200'>Heker biadab");
      $uploaded = random().".".$ext;
      
      if(copy($_FILES["img"]["tmp_name"], $uploaded)) {
        $img = "http://".$_SERVER["HTTP_HOST"]."/".$uploaded;
        $post = "source=$img&upload-expiration=&type=url&action=upload";
        $curl = curl("https://imgbb.com/json", $post);
        if(preg_match("/success/", $curl)) {
          $json = json_decode($curl, true);
          ?>
          
          <div class="flex flex-col justify-evenly mx-auto w-72 mt-5 md:w-80 h-72 max-h-75">
            <div class="mx-auto overflow-hidden bg-gray-300 w-5/6 border border-gray-500 rounded-3xl">
              <img src="<?php echo $json['image']['url'] ?>" class="mx-auto">
            </div>
            <div class="flex justify-center mx-auto w-4/5 sm:w-3/5 mt-2">
              <input type="text" class="w-66 md:w-72 py-1 px-1 mr-1 bg-transparent border-2 border-sky-600 rounded text-sky-600 text-center" id="link" value="<?php echo $json['image']['url'] ?>" disabled></input>
              <button type="button" class="bg-transparent border-2 border-sky-600 text-sky-600 px-2.5 rounded hover:bg-sky-600 hover:text-white active:scale-90 duration-200" id="copy">Copy</button>
            </div>
          </div>
          
          <?php
        } else {
          echo "<script>swal({
            type: 'error',
            title: 'Failed!',
            text: 'Failed to upload to ImgBB'
          })</script>";
        }
      } else {
        echo "<script>swal({
          type: 'error',
          title: 'Fail!',
          text: 'Upload file failed'
        })</script>";
      }
      unlink($uploaded);
    }
    ?>
    
    <script src="dist/js/script.js"></script>
  </body>
</html>