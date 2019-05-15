<?php
include '../load.php';
include '../../connect/login.php';

$userid =login::isLoggedIn();

if(isset($_POST['comment'])){
    
 $comment_text=$loadFromUser->checkInput($_POST['comment']); 
 $userid=$_POST['userid']; 
 $postId=$_POST['postid']; 
$commentid = $loadFromUser->create('comments', array('commentBy' => $userid,'comment_parent_id' => $postId,  'comment' => $comment_text,'commentOn' => $postId, 'commentAt' => date('Y-m-d H:i:s')));

    $commentDetails=$loadFromPost->lastCommentFetch($commentid);
    foreach($commentDetails as $comment){
        $com_react_max_show = $loadFromPost->com_react_max_show($comment->commentOn,$comment->commentID);
	    $main_react_count = $loadFromPost->com_main_react_count($comment->commentOn,$comment->commentID);
        
        
        ?>
    <li class="new-comment">
        <div class="com-details">
            <div class="com-pro-pic">
                <a href="#">
                    <div class="top-pic"><img src="<?php echo $comment->profilePic; ?>" alt=""></div>
                </a>
            </div>
            <div class="com-pro-wrap">
                <div class="com-pro-text align-middle">
                    <a href="#"><span class="nf-pro-name"><?php echo ''.$comment->firstName.' '.$comment->lastName.''; ?></span></a>
                    <div class="com-react-placeholder-wrap align-middle">
                        <div class="com-text" style="margin-left:5px;">
                            <?php echo $comment->comment; ?>
                        </div>
                        <div class="com-nf-3-wrap">
                            <?php
  
                                                    if($main_react_count->maxreact == '0'){echo 'its empty';}else{
    
                                                            ?>
                                <div class="com-nf-3 align-middle">
                                    <div class="nf-3-react-icon">
                                        <div class="react-inst-img align-middle" style="">
                                            <?php 
                                                            foreach($com_react_max_show as $react_max){
                                                                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:12px;width:12px;margin-right:2px;cursor:pointer;">';
                                                                 } ?>
                                        </div>
                                    </div>
                                    <div class="nf-3-react-username">
                                        <?php if($main_react_count->maxreact == '0'){}else{echo $main_react_count->maxreact;} ?>
                                    </div>
                                </div>
                                <?php   
    }
                    ?>
                        </div>

                    </div>
                </div>
                <div class="com-react">

                    <div class="com-like-react" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $comment->commentID; ?>">
                        <div class="com-react-bundle-wrap" data-commentid="<?php  echo $comment->commentID; ?>"></div>

                        <div class="com-like-action-text"><span>Like</span></div>

                    </div>
                    <div class="com-reply-action">Reply</div>
                    <div class="com-time"> 11h </div>
                </div>
            </div>

        </div>
    </li>


    <?php
    }
  
}




?>
