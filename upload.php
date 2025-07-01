<?php 

include 'includes/header.php';

$error = "";
$success = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    if(empty($title) || empty($description)){
        echo "Please Fill all the fields";
    }else{
        $target_dir = 'assets/images/';
        $file = $image['name'];
        $new_name = uniqid() . $file;
        $target_file = $target_dir . $new_name;
    }

    if($image['size'] > 5000000){
        echo "File Size must be less than 5 MB";
    }else{
        if(move_uploaded_file($image['tmp_name'],$target_file)){
            $sql = "INSERT INTO images(`title`,`description`, `filename`) VALUES(:title,:description,:filename);";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':filename' => $new_name,
            ]);
            $success ="Image Uploaded Successfully";
        }else{
            $error = "Error Uploading Image";            
        }
    }
}
?>

    <div class="container">
        <div class="my-4">
            <h1>Upload Image to Photo Gallery</h1>
        </div>

        <?php if($success) { ?>

            <div class="alert alert-success" role="alert">
                Image Uploaded Successfully 
            </div>
    
        <?php }?>

        <?php if($error) {?>

            <div class="alert alert-danger" role="alert">
                Error Uploading Image 
            </div>

        <?php }?>

        <div class="row">
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>                
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" rows="3"></textarea>                
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Select Image File</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>                
                </div>

                <button type="submit" class="btn btn-primary">Upload Image</button>

            </form>
        </div>
    </div>


<?php include 'includes/footer.php'; ?>