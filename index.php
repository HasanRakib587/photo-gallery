
<?php include 'includes/header.php';

$sql = "SELECT * FROM `images` ORDER BY `upload_date` DESC";

$stmt = $conn->query($sql);
$images = $stmt->fetchAll();
?>

<div class="my-5-text-center">
    <h1 class="display-4">Photo Gallery</h1>
    <?php if(empty($images)) { ?>
        <p class="lead">No Images Uploaded. Please upload some Image</p>
        <a href="upload.php" class="btn btn-primary">Upload Image</a>
    <?php } else { ?>
        <p class="lead">Browse the latest uploaded images</p>
    <?php  }?>
</div>
<div class="container">
    <div class="row">
        <?php if(!empty($images)) { ?>
                <?php foreach($images as $image) { ?>
                    <div class="col-lg-4">
                        <div class="card my-4 ">
                            <img src="assets/images/<?php echo htmlspecialchars($image['filename']); ?>" class="card-img-top" alt="<?php echo 'image of ' . $image['title']; ?>">        
                                <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($image['title']);?></h5>
                                <h6 class="card-subtitle text-muted">Uploaded on: <?php echo date("F,j,Y", strtotime($image['upload_date']))?></h6>
                                <p class="card-text"><?php echo htmlspecialchars($image['description']);?></p>      
                            </div>
                        </div>
                    </div>
                    
                <?php } ?>
            <?php }?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

