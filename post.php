<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php
$page_title = "Article";
$hide_notifications = true;
if (!$session->isUserLoggedIn()) {
    redirect("/login");
} 
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<div id="root2" class="single_article_page">
    <?php
        include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_mobile.php'); 
    ?>
    
           
    
    <div class="page_wrapper">
        <?php
        // Access the ID from the rewritten URL
        if (isset($_GET['post_id'])) {
            // Get the 'id' from the query string (now via rewrite rule)
            $postID = intval($_GET['post_id']); // Sanitize input

            // Now use $postID to query the database or perform other actions
            $result = $db->query( "SELECT * FROM articles WHERE ID = $postID");
            

            if ($result) {
                $post = $db->fetch_assoc($result);
                $sql = $db->query("SELECT * FROM media WHERE ID = '{$db->escape($post['image_id'])}'");
                $media = ($db->num_rows($sql) > 0) ? $db->fetch_assoc($sql) : ['file_path' => "/uploads/quiz_images/no_image.png"];
        ?>
            <div class="featured_image">
                <img src="<?php echo QUIZ_IMAGE_PATH.$media['file_path'] ?>" alt="">
            </div>
        <?php
                echo "<h1 class='mt-5'>" . htmlspecialchars($post['headline']) . "</h1>";
                echo "<div class='mb-5 mb-5 pb-5'>";
                echo $post['content'];
                echo "<br>";
                echo "</div>";
            } else {
                echo "Post not found.";
            }
        } else {
            echo "No post ID provided.";
        }
        ?>
    </div>

    <div class="bottom-navigation"><?php include_once("./layouts/bottom_navigation.php") ?></div>
</div>

<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<?php include './layouts/footerEnd.php'; ?>
