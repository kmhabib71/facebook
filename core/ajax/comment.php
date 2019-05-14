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
        
        ?>
    <li class="new-comment">
        <div class="com-details">
            <div class="com-pro-pic">
                <a href="#">
                    <div class="top-pic"><img src="<?php echo $comment->profilePic; ?>" alt=""></div>
                </a>
            </div>
            <div class="com-pro-wrap">
                <div class="com-pro-text">
                    <a href="#"><span class="nf-pro-name"><?php echo ''.$comment->firstName.' '.$comment->lastName.''; ?></span></a>
                    <?php echo $comment->comment; ?>
                </div>
                <div class="com-react">
                    <div class="com-like-react">Like</div>
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
