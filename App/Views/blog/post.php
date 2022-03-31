<!-- Breadcrumb -->
<ul class="breadcrumb box">
    <li>
        <a href="<?php echo url('/'); ?>">Home</a>
    </li>
    <li class="active"><?php echo $post->title; ?></li>
</ul>
<!-- /Breadcrumb -->
<!-- Main Content -->
<div class="col-sm-12 col-xs-12" id="main-content">
    <!-- Post Page -->
    <div id="post-page">
        <!-- Post Box -->
        <div class="box post-box wow fadeIn" data-wow-duration="3s">
            <div class="post-content">
            <span class="">
            <a href="<?php echo url('/post/' . seo($post->title) . '/' . $post->id); ?>"><?php echo $post->title; ?></a>,           
            <span class="date"><?php echo date('d/m/Y h:i A');?></span></span>
        <div class="clearfix"></div>
   
                <div class="clearfix"></div>
                <a href="#" class="image-box">
                    <img src="<?php echo assets('images/' . $post->image); ?>" alt="<?php echo $post->title; ?>" />
                </a>
                <p class="details">
                    <?php echo htmlspecialchars_decode($post->details); ?>
                </p>
            </div>
            <div id="post-author">
                <div class="name">
                   Author:   <?php echo $post->first_name . ' ' . $post->last_name; ?>
                 </div>
            </div>
        </div>
        <!--/ Post Box -->
        <!-- Comments -->
        <div id="comments" class="box">
            <!-- Total Comments -->
            <div id="total-comments">
                <span><?php echo count($post->comments); ?></span> Comments
            </div>
            <!--/ Total Comments -->
            <?php foreach ($post->comments AS $comment) { ?>
            <div class="comment">
                <div class="author-image">
                    <img src="<?php echo assets('images/' . $comment->userImage); ?> " alt="" />
                </div>
                <div class="comment-container">
                    <div class="author-name">
                        <?php echo $comment->first_name . ' ' . $comment->last_name; ?>
                    </div>
                    <div class="comment-date">
                        <?php echo date('d/m/Y h:i A', $comment->created); ?>
                    </div>
                    <div class="comment-text">
                        <?php echo $comment->comment; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!--/ Comments -->
        <!-- Comment Form -->
        <form action="<?php echo url('/post/' . seo($post->title) . '/' . $post->id . '/add-comment'); ?>" method="post" id="comment-form" class="box">
            <h3 class="heading">Post Comment</h3>
            <textarea name="comment" id="editor" class="input" placeholder="Post Your Comment" cols="30" rows="10" required="required"></textarea>
            <button class="comment-button">Submit</button>
        </form>
        <!--/ Comment Form -->
    </div>
    <!--/ Post Page  -->
</div>
<!--/ Main Content -->