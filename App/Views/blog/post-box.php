<!-- Post Box -->
<div class="box post-box wow fadeIn" data-wow-duration="3s">
    <div class="post-content">
        <span class="">
            <a href="<?php echo url('/post/' . seo($post->title) . '/' . $post->id); ?>"><?php echo $post->title; ?></a>,           
            <span class="date"><?php echo date('d/m/Y h:i A');?></span></span>
        <div class="clearfix"></div>
        <div class="row">
        <div class="col-sm-9 col-xs-9">
            <p class="details">
                <?php echo html_entity_decode(read_more_by_char($post->details, 1000)) ;?>
            </p>

            <br>
            <div class="row">
            <div class="col-sm-8 col-xs-8">
                Author: <span class="main"><?php echo $post->first_name . ' ' . $post->last_name; ?></span>

            </div>
            <div class="col-sm-3 col-xs-3 ">
                Comments:         <a href="#" class="comments">
            <span class="main"><?php echo $post->total_comments; ?></span>
             </a>
            </div>
            </div>
        </div>
        <div class="col-sm-3 col-xs-3">
        <a href="<?php echo url('/post/' . seo($post->title) . '/' . $post->id); ?>" class="image-box">
            <img src="<?php echo assets('images/' . $post->image); ?>" alt="<?php echo $post->title; ?>" />
        </a>
        </div>
    </div>

    <div class="post-box-footer">
        <a href="#" class="user">
            By:
        </a>

    </div>
</div>
<!--/ Post Box -->