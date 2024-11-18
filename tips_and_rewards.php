<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php
if (!$session->isUserLoggedIn()) {
    redirect("/login", false);
}
$page_title = "Tips & Rewards";
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php
$user = current_user();
$user_id = $user['ID'];
$userPersonas = [];
$UserProfile = find_by_sql("SELECT up.ID, up.profile_id, p.ID AS main_profile_id, p.profile_name FROM users_profiles up RIGHT JOIN profiles p ON up.profile_id = p.ID WHERE up.user_id = '{$db->escape($user_id)}'");
foreach ($UserProfile as $value) {
    array_push($userPersonas, ["persona_id" => $value['main_profile_id'], "persona_name" => $value['profile_name']]);
}
$rewardsContent = [];
$articlesContent = [];
$videosContent = [];
$trendingContent = [];
foreach ($userPersonas as $persona) {
    $persona_id = $persona['persona_id'];
    $rewards = find_by_sql("SELECT pcr.*, r.*, i.file_name, i.file_path FROM persona_content_relations pcr RIGHT JOIN rewards r ON pcr.content_id = r.ID  RIGHT JOIN media i on r.image_id = i.ID WHERE pcr.content_type = 'reward' AND pcr.persona_id = '$persona_id'");
    array_push($rewardsContent, $rewards);
    $articles = find_by_sql("SELECT pcr.*, r.*, i.file_name, i.file_path FROM persona_content_relations pcr RIGHT JOIN articles r ON pcr.content_id = r.ID RIGHT JOIN media i on r.image_id = i.ID  WHERE pcr.content_type = 'article' AND pcr.persona_id = '$persona_id' AND r.trending = '0' ORDER BY r.ID DESC");
    array_push($articlesContent, $articles);
    $videos = find_by_sql("SELECT pcr.*, r.*, i.file_name, i.file_path FROM persona_content_relations pcr RIGHT JOIN videos r ON pcr.content_id = r.ID RIGHT JOIN media i on r.image_id = i.ID  WHERE pcr.content_type = 'video' AND pcr.persona_id = '$persona_id' ORDER BY r.ID DESC");
    array_push($videosContent, $videos);
    $trending = find_by_sql("SELECT pcr.*, r.*, i.file_name, i.file_path FROM persona_content_relations pcr RIGHT JOIN articles r ON pcr.content_id = r.ID RIGHT JOIN media i on r.image_id = i.ID  WHERE pcr.content_type = 'article' AND pcr.persona_id = '$persona_id' AND r.trending = '1' ORDER BY r.ID DESC");
    empty($trending) ? "" : array_push($trendingContent, $trending);
}
// print_r($trendingContent);
// echo "------------------------------------ Begining of Rewards Array -----------------------------";
// echo "<br>";
// print_r($rewardsContent);
// echo "<br>";
// echo "------------------------------------ end of Rewards Array -----------------------------";
// echo "<br>";
// echo "------------------------------------ begining of Articles Array -----------------------------";
// echo "<br>";
// print_r($articlesContent);
// echo "<br>";
// echo "------------------------------------ end of Articles Array -----------------------------";
// echo "<br>";
// echo "------------------------------------ begingin of videos Array -----------------------------";
// echo "<br>";
// print_r($videosContent);
// echo "<br>";
// echo "------------------------------------ end of videos Array -----------------------------";
// $rewards = find_by_sql("SELECT r.ID  FROM rewards")

?>


<!-- Modal Structure -->
<div class="modal fade" id="rewardModal" tabindex="-1" aria-labelledby="rewardModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rewardModalLabel">Reward Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="rewardImage" src="" alt="Reward Image" class="img-fluid mb-3">
        <p id="rewardDescription"></p>
        <p id="rewardDate"></p>
      </div>
    </div>
  </div>
</div>



<div id="root2" class="tips_and_rewards_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/header_with_search.php');
    ?>

    <div class="tips_and_rewards_page_wrapper">
        <?php if (isset($articlesContent[0]) && !empty($articlesContent[0])): ?>
            <section class="hero_section">
                <div class="container">
                    <div class="hero_wrapper">
                        <h1 class="hero_title"><?php echo $articlesContent[0][0]["headline"]; ?></h1>
                        <p class="hero_para"><?php echo preview_content($articlesContent[0][0]["content"]); ?></p>
                        <div class="hero_action">
                            <a href="/post?post_id=<?php echo $articlesContent[0][0]["ID"]; ?>"><button class="button primary-button">Read More</button></a>
                        </div>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <div class="rewards_container">
                        <div id="rewards_for_js" class="">
                            <h4 class="text-center fs-6 font-weight-bolder">No Rewards found, please check back later</h4>
                        </div>
                    </div>
        <?php endif; ?>
        <section class="rewards_section">
            <div class="container-fluid px-lg-5">
                <h2 class="section-title">Rewards</h2>
                <?php if (isset($rewardsContent[0]) && !empty($rewardsContent[0])): ?>
                    <div class="rewards_container">
                        <div id="rewards_for_js" class="reward_item_container horizontal-scroll">
                            <?php foreach ($rewardsContent as $theReward): ?>
                                <?php foreach ($theReward as $reward): ?>
                                    <div class="reward_item" 
                                        data-title="<?php echo $reward['reward_title']; ?>" 
                                        data-description="<?php echo $reward['reward_description']; ?>" 
                                        data-date="<?php echo date("F Y", strtotime($reward['created_at'])); ?>" 
                                        data-image="<?php echo (isset($reward['file_path'])) ? QUIZ_IMAGE_PATH . $reward['file_path'] : '/assets/images/(O).png'; ?>">
                                        <div class="featured_image_wrapper d-none">
                                            <div class="bookmark">
                                                <i class="fa-regular fa-bookmark"></i>
                                            </div>
                                            <img src="<?php echo (isset($reward['file_path'])) ? QUIZ_IMAGE_PATH . $reward['file_path'] : "/assets/images/(O).png" ?>" alt="">
                                        </div>
                                        <div class="title">
                                            <h2><?php echo (isset($reward['reward_title'])) ? $reward['reward_title'] : "Title Not Found"; ?></h2>
                                        </div>
                                        <div class="description d-none">
                                            <h2><?php echo (isset($reward['reward_description'])) ? $reward['reward_description'] : "Title Not Found"; ?></h2>
                                        </div>
                                        <div class="date">
                                            <?php
                                            $time_stamp = strtotime($reward['created_at']);
                                            ?>
                                            <p><?php echo date("F", $time_stamp); ?> <?php echo date("Y", $time_stamp); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="rewards_container">
                        <div id="rewards_for_js" class="">
                            <h4 class="text-center fs-6 font-weight-bolder">No Rewards found, please check back later</h4>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($articlesContent[0][1]) && !empty($articlesContent[0][1])): ?>
                    <div class="rewards_video_section mt-5">
                        <div class="rewards_video_wrapper">
                            <div class="big_video_column" data-id='<?php echo (isset($articlesContent[0][1]['ID'])) ? $articlesContent[0][1]['ID'] : "0"; ?>'>
                                <div class="main_video">

                                    <img src="<?php echo (isset($articlesContent[0][1]['file_path'])) ? QUIZ_IMAGE_PATH . $articlesContent[0][1]['file_path'] : "/assets/images/(O).png"; ?>" alt="">
                                    <div class="video_overlay">
                                        <div class="video_information">
                                            <div class="category">
                                                <p>Technology</p>
                                            </div>
                                            <div class="title">
                                                <h2><?php echo (isset($articlesContent[0][1]['headline'])) ? $articlesContent[0][1]['headline'] : "Title Not Set"; ?></h2>
                                            </div>
                                            <div class="meta">
                                                <div class="meta_profile_picture">
                                                    <span>32x32</span>
                                                </div>
                                                <div class="creator_name">
                                                    <p> Emma Savanah</p>
                                                </div>
                                                <div class="meta_details">
                                                    <ul>
                                                        <li>
                                                            <p class="time_elapsed">16m ago</p>
                                                        </li>
                                                        <li>
                                                            <div class="total_comments">
                                                                <i class="fa-solid fa-comment"></i>
                                                                <span class="commnets_count">37</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="video_array_column">
                                <div class="videos_array">
                                    <?php
                                    $skipFirst = true;
                                    $skipSecond = true;
                                    $counter = 0;
                                    foreach ($articlesContent[0] as $article):
                                        // foreach ($theArticles as $article):
                                    ?>
                                            
                                        <?php if ($skipFirst) {
                                            $skipFirst = false;
                                            continue;
                                        } elseif ($skipFirst == false && $skipSecond == true) {
                                            $skipSecond = false;
                                            continue;
                                        };
                                        if ($counter > 5) {
                                            continue;
                                        }
                                        ?>
                                        <div class="video" data-id="<?php echo (isset($article['ID'])) ? $article['ID'] : "0"; ?>">
                                            <div class="featured_image">
                                                <img src="<?php echo (isset($article['file_path'])) ? QUIZ_IMAGE_PATH . $article['file_path'] : "/assets/images/(O).png"; ?>" alt="">
                                            </div>
                                            <div class="video_info">
                                                <div class="video_array_contents">
                                                    <h2 class="title"><?php echo (isset($article['headline'])) ? preview_content($article['headline'], 15) : "Title Not Set"; ?></h2>
                                                    <div class="meta">
                                                        <p class="creator">Fernando Agaro</p>
                                                        <ul>
                                                            <li>16m ago</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="bookmark">
                                                    <i class="fa-solid fa-bookmark"></i>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        // endforeach;
                                        $counter += 1;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <h2 class="section-title mt-5 pt-5">Articles</h2>
                    <div class="">
                        <h4 class="text-center fs-6 font-weight-bolder">No Articles found, please check back later</h4>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- <section class="popular_author_section">
            <div class="container-fluid px-lg-5">
                <div class="d-flex justify-content-between">
                    <h2 class="section-title">Popular Authors</h2>
                    <div class="see-all">
                        <a href="#">See all <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="authors_slider_column">
                    <div class="authors_grid">
                        <div class="item">
                            <div class="profile_icon"></div>
                            <div class="grid_info">
                                <h2>Gerard Fabiano</h2>
                                <p>Los Angeles</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="profile_icon"></div>
                            <div class="grid_info">
                                <h2>Gerard Fabiano</h2>
                                <p>Los Angeles</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="profile_icon"></div>
                            <div class="grid_info">
                                <h2>Gerard Fabiano</h2>
                                <p>Los Angeles</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="profile_icon"></div>
                            <div class="grid_info">
                                <h2>Gerard Fabiano</h2>
                                <p>Los Angeles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="rewards_section popular_section">
            <div class="container-fluid px-lg-5">
                <h2 class="section-title">Popular Authors</h2>
                <div class="rewards_container">
                    <div class="reward_item_container horizontal-scroll">
                        <div class="reward_item">
                            <div class="featured_image_wrapper">
                                <div class="bookmark">
                                </div>
                                <img src="/assets/images/(O).png" alt="">
                            </div>
                            <div class="date">
                                <p>Entertainment</p>
                            </div>
                            <div class="title">
                                <h2>Watch these masterpieces to un</h2>
                            </div>
                            <div class="meta">
                                <div class="meta_profile_picture">
                                    <img src="" alt="">
                                </div>
                                <div class="meta_details">
                                    <span class="category">Good News</span>
                                    <ul>
                                        <li>
                                            <p class="time_elapsed">16m ago</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="reward_item">
                            <div class="featured_image_wrapper">
                                <div class="bookmark">
                                </div>
                                <img src="/assets/images/(O).png" alt="">
                            </div>
                            <div class="date">
                                <p>Entertainment</p>
                            </div>
                            <div class="title">
                                <h2>Watch these masterpieces to un</h2>
                            </div>
                            <div class="meta">
                                <div class="meta_profile_picture">
                                    <img src="" alt="">
                                </div>
                                <div class="meta_details">
                                    <span class="category">Good News</span>
                                    <ul>
                                        <li>
                                            <p class="time_elapsed">16m ago</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="reward_item">
                            <div class="featured_image_wrapper">
                                <div class="bookmark">
                                </div>
                                <img src="/assets/images/(O).png" alt="">
                            </div>
                            <div class="date">
                                <p>Entertainment</p>
                            </div>
                            <div class="title">
                                <h2>Watch these masterpieces to un</h2>
                            </div>
                            <div class="meta">
                                <div class="meta_profile_picture">
                                    <img src="" alt="">
                                </div>
                                <div class="meta_details">
                                    <span class="category">Good News</span>
                                    <ul>
                                        <li>
                                            <p class="time_elapsed">16m ago</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="reward_item">
                            <div class="featured_image_wrapper">
                                <div class="bookmark">
                                </div>
                                <img src="/assets/images/(O).png" alt="">
                            </div>
                            <div class="date">
                                <p>Entertainment</p>
                            </div>
                            <div class="title">
                                <h2>Watch these masterpieces to un</h2>
                            </div>
                            <div class="meta">
                                <div class="meta_profile_picture">
                                    <img src="" alt="">
                                </div>
                                <div class="meta_details">
                                    <span class="category">Good News</span>
                                    <ul>
                                        <li>
                                            <p class="time_elapsed">16m ago</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="reward_item">
                            <div class="featured_image_wrapper">
                                <div class="bookmark">
                                </div>
                                <img src="/assets/images/(O).png" alt="">
                            </div>
                            <div class="date">
                                <p>Entertainment</p>
                            </div>
                            <div class="title">
                                <h2>Watch these masterpieces to un</h2>
                            </div>
                            <div class="meta">
                                <div class="meta_profile_picture">
                                    <img src="" alt="">
                                </div>
                                <div class="meta_details">
                                    <span class="category">Good News</span>
                                    <ul>
                                        <li>
                                            <p class="time_elapsed">16m ago</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </div>

    <div class="bottom-navigation"><?php include_once("./layouts/bottom_navigation.php") ?></div>
</div>










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    $(document).ready(function() {
        $('.reward_item').on('click', function() {
            // Get reward details from data attributes
            var title = $(this).data('title');
            var description = $(this).data('description');
            var date = $(this).data('date');
            var image = $(this).data('image');

            // Populate the modal with the reward details
            $('#rewardModalLabel').text(title);
            $('#rewardDescription').text(description);
            $('#rewardDate').text(date);
            $('#rewardImage').attr('src', image);

            // Show the modal
            $('#rewardModal').modal('show');
        });

        $(".big_video_column, .video_array_column .video").on("click", (e) => {
            e.preventDefault();
            var post_id = $(e.currentTarget).data("id");
            window.location.assign("/post?post_id=" + post_id);
        })
    });
</script>
<?php include './layouts/footerEnd.php'; ?>