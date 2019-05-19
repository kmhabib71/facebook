<?Php
class Post extends User {


	function __construct($pdo){
		$this->pdo = $pdo;
	}
	public function posts($user_id,$profileId, $num){

 $userdata = $this->userData($user_id);

		$stmt = $this->pdo->prepare("SELECT users.*, post.*, profile.* from users, post, profile WHERE users.user_id = :user_id AND post.postBy = :user_id AND profile.userId =:user_id  ORDER BY post.postedOn DESC LIMIT :num");
//        $stmt = $this->pdo->prepare("SELECT * FROM posts LEFT JOIN users ON postBy = user_id WHERE postBy = :user_id AND repostID ='0' OR postBy = user_id AND repostBy != :user_id AND `postBy` IN(SELECT `receiver` FROM `follow` WHERE `sender` = :user_id) ORDER BY `postID` DESC LIMIT :num");
		$stmt->bindParam(":user_id", $profileId, PDO::PARAM_INT);
		$stmt->bindParam(":num", $num, PDO::PARAM_INT);
		$stmt->execute();
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);
		foreach($posts as $post){
			$main_react = $this->main_react($user_id, $post->post_id);
			$react_max_show = $this->react_max_show($post->post_id);
			$main_react_count = $this->main_react_count($post->post_id);

//			$repost = $this->checkRepost($post->postID, $user_id);
//			$user = $this->userData($post->repostBy);
          $commentDetails=$this->CommentFetch($post->post_id);
			?>
    <div class="profile-timeline">
        <div class="news-feed-comp">
            <div class="news-feed-text">
                <div class="nf-1">
                    <div class="nf-1-left">
                        <div class="nf-pro-pic">
                            <a href="<?php echo BASE_URL.$post->userLink; ?>">
                                <img src="<?php echo BASE_URL.$post->profilePic; ?>" class="pro-pic" alt="">
                            </a>
                        </div>
                        <div class="nf-pro-name-time">
                            <div class="nf-pro-name">
                                <a href="<?php echo BASE_URL.$post->userLink; ?>" class="nf-pro-name"><?php echo ''.$post->firstName.' '.$post->lastName.''; ?></a>

                            </div>
                            <div class="nf-pro-time-privacy">
                                <div class="nf-pro-time">
                                    <?php echo $this->timeAgo($post->postedOn); ?>
                                </div>
                                <div class="nf-pro-privacy"></div>
                            </div>
                        </div>
                    </div>
                    <div class="nf-1-right">
                        <div class="nf-1-right-dott">
                            <div class="post-option" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>">...</div>

                            <div class="post-option-details-container"></div>


                        </div>

                    </div>
                </div>
                <div class="nf-2">
                    <div class="nf-2-text" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>">
                        <?php echo $post->post; ?>
                    </div>
                    <div class="nf-2-img" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>">
                        <?php $imgJson = json_decode($post->postImage);
                            $count = 0;
                                for($i = 0; $i < count($imgJson); $i++) {
                                    echo '<div class="post-img-box" data-postImgID="'.$post->id.'" style="max-height: 400px;
    overflow: hidden;"><img src="'.BASE_URL.$imgJson[''.$count++.'']->imageName.'" alt="" style="width: 100%;"></div>';
                                }



                        ?>
                    </div>

                </div>
                <div class="nf-3">
                    <div class="nf-3-react-icon">
                        <div class="react-inst-img align-middle" style="">
                            <?php






                foreach($react_max_show as $react_max){
                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:15px;width:15px;margin-right:2px;cursor:pointer;">';

                 } ?>


                        </div>

                    </div>
                    <div class="nf-3-react-username">
                        <!--                        Farhan kabir, Shafiq Rahim and 38 others-->
                        <?php if($main_react_count->maxreact == '0'){}else{echo $main_react_count->maxreact;} ?>

                    </div>
                </div>
                <div class="nf-4">
                    <style>


                    </style>
                    <div class="like-action-wrap" data-postId="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>" style="position:relative;">
                        <div class="react-bundle-wrap">

                        </div>

                        <div class="like-action ra">
                            <?php if(empty($main_react)){
                            ?>
                            <div class="like-action-icon">
                                <img src="assets/images/likeAction.JPG" alt="">
                            </div>
                            <div class="like-action-text"><span>Like</span></div>
                            <?php
                        }else{  ?>
                                <div class="like-action-icon">
                                    <img class="reactIconSize" src="assets/images/react/<?php echo $main_react->reactType; ?>.png" alt="">
                                </div>
                                <div class="like-action-text">
                                    <span class="<?php echo $main_react->reactType; ?>-color">
                                    <?php echo $main_react->reactType; ?>
                                    </span></div>


                                <?php } ?>
                        </div>

                    </div>
                    <div class="comment-action ra">
                        <div class="comment-action-icon">
                            <img src="assets/images/commentAction.JPG" alt="">
                        </div>
                        <div class="comment-action-text">Comment</div>
                    </div>
                    <div class="share-action ra">
                        <div class="share-action-icon"><img src="assets/images/shareAction.JPG" alt=""></div>
                        <div class="share-action-text">Share</div>
                    </div>
                </div>
                <div class="nf-5">
                    <div class="comment-list">
                        <ul class="add-comment">
                            <?php foreach($commentDetails as $comment){

                                   $com_react_max_show = $this->com_react_max_show($comment->commentOn,$comment->commentID);
	                               $main_react_count = $this->com_main_react_count($comment->commentOn,$comment->commentID);
	                               $commentReactCheck = $this->commentReactCheck($user_id,$comment->commentOn,$comment->commentID);


        ?>
                            <li class="new-comment">
                                <div class="com-details">
                                    <div class="com-pro-pic">
                                        <a href="#">
                                            <div class="top-pic"><img src="<?php echo $comment->profilePic; ?>" alt=""></div>
                                        </a>
                                    </div>
                                    <div class="com-pro-wrap">
                                        <div class="com-text-react-wrap">
                                            <div class="com-pro-text align-middle">
                                                <a href="#"><span class="nf-pro-name"><?php echo ''.$comment->firstName.' '.$comment->lastName.''; ?></span></a>
                                                <div class="com-react-placeholder-wrap align-middle">
                                                    <div class="com-text" style="margin-left:5px;">
                                                        <?php echo $comment->comment; ?>
                                                    </div>
                                                    <div class="com-nf-3-wrap">
                                                        <?php

                                                    if($main_react_count->maxreact == '0'){}else{

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

                                                <div class="com-like-react " data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $comment->commentID; ?>">
                                                    <div class="com-react-bundle-wrap" data-commentid="<?php  echo $comment->commentID; ?>"></div>

                                                    <?php if(empty($commentReactCheck)){echo '<div class="com-like-action-text"><span>Like</span></div>';}else{
                        echo '<div class="com-like-action-text"><span class="'.$commentReactCheck->reactType.'-color">'.$commentReactCheck->reactType.'</span></div>';
                    }
?>
                                                </div>
                                                <div class="com-reply-action" data-postid="<?php echo $post->post_id; ?>" data-userid="
                                                    <?php echo $user_id; ?>" data-commentid="
                                                    <?php echo $comment->commentID; ?>" data-profilepic="<?php echo $userdata->profilePic; ?>">Reply</div>
                                                <div class="com-time"> 11h </div>
                                            </div>
                                        </div>

                                        <div class="reply-wrap">
                                            <div class="reply-text-wrap">
                                                <ul class="old-replay">


                                                    <?php
                                                    $replyDetails=$this->replyFetch($comment->commentOn,$comment->commentID);


    foreach($replyDetails as $reply){
        $reply_react_max_show = $this->reply_react_max_show($reply->commentOn,$reply->commentID,$reply->commentReplyID);
	    $reply_react_count = $this->reply_main_react_count($reply->commentOn,$reply->commentID,$reply->commentReplyID);
        $replytReactCheck = $this->replyReactCheck($user_id,$reply->commentOn,$reply->commentID,$reply->commentReplyID);

        ?>
                                                        <li class="new-reply" style="margin-top:5px;">
                                                            <!--                                                        ///.......demo reply comment......////-->


                                                            <div class="com-details">
                                                                <div class="com-pro-pic">
                                                                    <a href="#">
                                                                        <div class="top-pic"><img src="<?php echo $reply->profilePic; ?>" alt=""></div>
                                                                    </a>
                                                                </div>
                                                                <div class="com-pro-wrap">
                                                                    <div class="com-text-react-wrap">
                                                                        <div class="com-pro-text align-middle">
                                                                            <a href="#"><span class="nf-pro-name"><?php echo ''.$reply->firstName.' '.$reply->lastName.''; ?></span></a>
                                                                            <div class="com-react-placeholder-wrap align-middle">
                                                                                <div class="com-text" style="margin-left:5px;">
                                                                                    <?php echo $reply->comment; ?>
                                                                                </div>
                                                                                <div class="com-nf-3-wrap">
                                                                                    <?php
                                if($reply_react_count->maxreact == '0'){}else{

                                                            ?>
                                                                                        <div class="com-nf-3 align-middle">
                                                                                            <div class="nf-3-react-icon">
                                                                                                <div class="react-inst-img align-middle" style="">
                                                                                                    <?php
                                                            foreach($reply_react_max_show as $react_max){
                                                                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:12px;width:12px;margin-right:2px;cursor:pointer;">';
                                                                 } ?> </div>
                                                                                            </div>
                                                                                            <div class="nf-3-react-username">
                                                                                                <?php if($reply_react_count->maxreact == '0'){}else{echo $reply_react_count->maxreact;} ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php
    }
                    ?>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="com-react">

                                                                            <div class="com-like-react reply" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $reply->commentID; ?>" data-commentparentid="<?php  echo $reply->commentReplyID; ?>">
                                                                                <div class="com-react-bundle-wrap reply" data-commentid="<?php  echo $reply->commentID; ?>" data-commentparentid="<?php  echo $reply->commentReplyID; ?>"></div>

                                                                                <?php if(empty($replytReactCheck)){echo '<div class="reply-like-action-text"><span>Like</span></div>';}else{
                        echo '<div class="reply-like-action-text"><span class="'.$replytReactCheck->reactType.'-color">'.$replytReactCheck->reactType.'</span></div>';
                    }
?>


                                                                            </div>
                                                                            <div class="com-reply-action-child" style="cursor:pointer;" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $reply->commentReplyID; ?>" data-profilepic="<?php  echo $userdata->profilePic; ?>">Reply</div>
                                                                            <div class="com-time"> 11h </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>


                                                            <!--                                                        ///.......demo reply comment......////-->


                                                        </li>


                                                        <?php
    }

                    ?>

                                                </ul>
                                            </div>
                                            <div class="replyInput">


                                            </div>
                                        </div>
                                        <!--
                                        <div class="reply-wrap">
                                            <div class="reply-text-wrap">
                                                <ul class="old-replay">
                                                    <li class="new-reply">This is reply text </li>
                                                </ul>
                                            </div>
                                            <div class="replyInput">
                                                <div class="comment-write">
                                                    <div class="com-pro-pic" style="margin-top: 4px;">
                                                        <a href="#">
                                                            <div class="top-pic"><img src="assets/images/me.jpg" alt=""></div>
                                                        </a>
                                                    </div>
                                                    <div class="com-input" style="">
                                                        <div class="comment-input" style="flex-basis:75%;">
                                                            <input type="text" name="" id="" class="comment-input-style comment-submit" style="" data-postid="<?php echo $post->post_id; ?>" data-userid="
                                                    <?php echo $user_id; ?>" placeholder="Write a comment...">
                                                </div>
                                                <div class="comment-input-option ">
                                                    <div class="imoji-action align-middle">
                                                        <img src="<?php echo ''.BASE_URL.'/assets/images/emojiAction.JPG'; ?>" alt="">
                                                    </div>
                                                    <div class="cam-action align-middle">
                                                        <img src="<?php echo ''.BASE_URL.'/assets/images/commentCamera.JPG'; ?>" alt="">
                                                    </div>
                                                    <div class="gif-action align-middle">
                                                        <img src="<?php echo ''.BASE_URL.'/assets/images/commentGif.JPG'; ?>" alt="">
                                                    </div>
                                                    <div class="sticker-action align-middle">
                                                        <img src="<?php echo ''.BASE_URL.'/assets/images/commentSticker.JPG'; ?>" alt="">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                </div>
                                -->
                                    </div>

                                </div>
                            </li>



                            <?php
    } ?>

                        </ul>
                    </div>
                    <div class="comment-write">
                        <div class="com-pro-pic" style="margin-top: 4px;">
                            <a href="#">
                                <div class="top-pic"><img src="<?php echo $userdata->profilePic; ?>" alt=""></div>
                            </a>
                        </div>
                        <div class="com-input" style="">
                            <div class="comment-input" style="flex-basis:75%;">
                                <input type="text" name="" id="" class="comment-input-style comment-submit" style="" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>" placeholder="Write a comment...">
                            </div>
                            <div class="comment-input-option ">
                                <div class="imoji-action align-middle">
                                    <img src="<?php echo ''.BASE_URL.'/assets/images/emojiAction.JPG'; ?>" alt="">
                                </div>
                                <div class="cam-action align-middle">
                                    <img src="<?php echo ''.BASE_URL.'/assets/images/commentCamera.JPG'; ?>" alt="">
                                </div>
                                <div class="gif-action align-middle">
                                    <img src="<?php echo ''.BASE_URL.'/assets/images/commentGif.JPG'; ?>" alt="">
                                </div>
                                <div class="sticker-action align-middle">
                                    <img src="<?php echo ''.BASE_URL.'/assets/images/commentSticker.JPG'; ?>" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="news-feed-photo"></div>
        </div>
    </div>


    <?php
		}
	}
	public function getUserTweets($user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `posts` LEFT JOIN `users` ON `postBy` = `user_id` WHERE `postBy` = :user_id AND `repostID` = '0' OR `repostBy` = :user_id ORDER BY postedOn DESC");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

    public function main_react($userid, $postid){
        $stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :postid AND  `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $userid, PDO::PARAM_INT);
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function react_max_show($postid){
        $stmt = $this->pdo->prepare("SELECT reactType, count(*) as maxreact from react WHERE reactOn = :postid AND reactCommentOn = '0' AND `reactReplyOn` = '0' GROUP by reactType LIMIT 3;");
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function main_react_count($postid){
        $stmt = $this->pdo->prepare("SELECT count(*) as maxreact from react WHERE reactOn = :postid AND reactCommentOn = '0' AND `reactReplyOn` = '0';");
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function com_react_max_show($postid,$commentid){
        $stmt = $this->pdo->prepare("SELECT reactType, count(*) as maxreact from react WHERE reactOn = :postid AND reactCommentOn = :commentID AND  `reactReplyOn` = '0' GROUP by reactType LIMIT 3");
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
			$stmt->bindParam(":commentID", $commentid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function reply_react_max_show($postid,$commentid,$replyid){
        $stmt = $this->pdo->prepare("SELECT reactType, count(*) as maxreact from react WHERE reactOn = :postid AND reactCommentOn = :commentID AND  `reactReplyOn` = :replyid GROUP by reactType LIMIT 3");
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
			$stmt->bindParam(":commentID", $commentid, PDO::PARAM_INT);
			$stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function com_main_react_count($postid,$commentid){
        $stmt = $this->pdo->prepare("SELECT count(*) as maxreact from react WHERE reactOn = :postid AND reactCommentOn = :commentID AND  `reactReplyOn` = '0';");
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        	$stmt->bindParam(":commentID", $commentid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function reply_main_react_count($postid,$commentid, $replyid){
        $stmt = $this->pdo->prepare("SELECT count(*) as maxreact from react WHERE reactOn = :postid AND reactCommentOn = :commentID AND  `reactReplyOn` = :replyid;");
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        	$stmt->bindParam(":commentID", $commentid, PDO::PARAM_INT);
        	$stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function commentReactCheck($userid, $postid, $commentID){
        $stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :postid AND  `reactCommentOn` = :commentid AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $userid, PDO::PARAM_INT);
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
			$stmt->bindParam(":commentid", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function replyReactCheck($userid, $postid, $commentID, $replyID){
        $stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :postid AND  `reactCommentOn` = :commentid AND `reactReplyOn` = :replyid");
			$stmt->bindParam(":user_id", $userid, PDO::PARAM_INT);
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
			$stmt->bindParam(":commentid", $commentID, PDO::PARAM_INT);
			$stmt->bindParam(":replyid", $replyID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function lastCommentFetch($commentid){
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentID = :commentid");
			$stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function lastReplyFetch($replyid){
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentID = :replyid");
			$stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function CommentFetch($postid){
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentOn = :postid AND comments.commentReplyID = '0' LIMIT 10");
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function replyFetch($postid,$commentID){
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentOn = :postid AND comments.commentReplyID = :commentid LIMIT 10");
			$stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
			$stmt->bindParam(":commentid", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
public function postUpd($user_id, $post_id, $editText){
			$stmt = $this->pdo->prepare("UPDATE `post` SET `post` = :editText WHERE `post_id` = :post_id AND `userId` = :user_id ");
			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
    	   $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    	   $stmt->bindParam(":editText", $editText, PDO::PARAM_INT);
			$stmt->execute();

		}









	public function addLike($user_id, $post_id, $get_id){
			$stmt = $this->pdo->prepare("UPDATE `posts` SET `likesCount` = `likesCount` +1 WHERE `postID` = :post_id");
			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
			$stmt->execute();

			$this->create('likes', array('likeBy' => $user_id, 'likeOn' =>$post_id));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $post_id, 'like');
			}
		}
		public function unLike($user_id, $post_id, $get_id){
			$stmt = $this->pdo->prepare("UPDATE `posts` SET `likesCount` = `likesCount` -1 WHERE `postID` = :post_id");
			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
			$stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :post_id");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
			$stmt->execute();
		}

//		public function main_react($user_id, $post_id){
//			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `likeOn` = :post_id ");
//			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
//			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
//			$stmt->execute();
//			return $stmt->fetch(PDO::FETCH_ASSOC);
//
//		}

	public function getTrendByHash($hashtag){
		$stmt=$this->pdo->prepare("SELECT * FROM `trends` WHERE `hashtag` LIKE :hashtag LIMIT 5");
		$stmt->bindValue(':hashtag', $hashtag.'%');
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);


	}
		public function getMention($mention){
			$stmt = $this->pdo->prepare("SELECT `user_id`, `username`, `screenName`, `profileImage` FROM `users` WHERE `username` LIKE :mention or `screenName` LIKE :mention LIMIT 5");
			$stmt->bindValue(':mention', $mention.'%');
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function addTrend($hashtag){
			//here i case sensitive and + refers to the more in next.
			//ekhane $hashtag input $matches output
			preg_match_all("/#+([a-zA-Z0-9_]+)/i", $hashtag, $matches);
			if($matches){
				$result = array_values($matches[1]);
				}
				$sql = "INSERT INTO `trends` (`hashtag`, `createdOn`) VALUES (:hashtag, CURRENT_TIMESTAMP)";
				foreach ($result as $trend) {
					if($stmt = $this->pdo->prepare($sql)){
						$stmt->execute(array(':hashtag' => $trend));

				}
			}
		}
		public function addMention($status, $user_id, $post_id){
			//here i case sensitive and + refers to the more in next.
			preg_match_all("/@+([a-zA-Z0-9_]+)/i", $status, $matches);
			if($matches){
				$result = array_values($matches[1]);
				}
				$sql = "SELECT * FROM `users` WHERE `username` = :mention";
				foreach ($result as $trend) {
					if($stmt = $this->pdo->prepare($sql)){
						$stmt->execute(array(':mention' => $trend));
						$data = $stmt->fetch(PDO::FETCH_OBJ);
					}
				}
				if($data->user_id != $user_id){
					Message::sendNotification($data->user_id, $user_id, $post_id, 'mention');

				}

		}
		public function getTweetLinks($post){
			$post = preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $post );
			$post = preg_replace("/#([\w]+)/", "<a href='".BASE_URL."hashtag/$1'>$0</a>",$post);
			$post = preg_replace("/@([\w]+)/", "<a href='".BASE_URL."$1'>$0</a>",$post);
			return $post;
		}
		public function getPopupTweet($post_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `posts`, `users` WHERE `postID` = :post_id AND `postBy` = `user_id`");
			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);

		}

		public function repost($post_id, $user_id, $get_id, $comment){
			$stmt = $this->pdo->prepare("UPDATE `posts` SET `repostCount` = `repostCount`+1 WHERE `postID` = :post_id");
			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
			$stmt->execute();

			$stmt = $this->pdo->prepare("INSERT INTO `posts` (`status`,`postBy`,`postImage`, `repostID`,`repostBy`,`postedOn`,`likesCount`,`repostCount`,`repostMsg`) SELECT `status`,`postBy`,`postImage`,`postId`, :user_id, `postedOn`,`likesCount`,`repostCount`, :repostMsg FROM `posts` WHERE `postID` = :post_id ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":repostMsg", $comment, PDO::PARAM_STR);
			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
			$stmt->execute();
			Message::sendNotification($get_id, $user_id, $post_id, 'repost');

		}

		public function checkRepost($post_id, $user_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `posts` WHERE `repostID` = :post_id AND `repostBy` = :user_id OR `postID` = :post_id AND `repostBy` = :user_id");
			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		public function comments($post_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :post_id");
			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function countTweets($user_id){
			$stmt = $this->pdo->prepare("SELECT COUNT(`postID`) AS `totalTweets` FROM `posts` WHERE `postBy` = :user_id AND `repostID` = '0' OR `repostBy` = :user_id");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->fetch(PDO::FETCH_OBJ);
			echo $count->totalTweets;

		}

		public function countLikes($user_id){
			$stmt = $this->pdo->prepare("SELECT COUNT(`likeID`) AS `totalLikes` FROM `likes` WHERE `likeBy` = :user_id ");
			$stmt->bindParam(":user_id", $user_id, PDO ::PARAM_INT);
			$stmt->execute();
			$count = $stmt->fetch(PDO::FETCH_OBJ);
			echo $count->totalLikes;
		}

		public function trends(){
			$stmt = $this->pdo->prepare("SELECT *, COUNT(`postID`) AS `postsCount` FROM `trends` INNER JOIN `posts` ON `status` LIKE CONCAT('%#',`hashtag`,'%') OR `repostMsg` LIKE CONCAT('%#',`hashtag`,'%') GROUP BY `hashtag` ORDER BY `postID`");
			$stmt->execute();
			$trends = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo '<div class="trend-wrapper"><div class="trend-inner"><div class="trend-title"><h3>Trends</h3></div><!-- trend title end-->
';
			foreach($trends as $trend){
				echo '<div class="trend-body">
	<div class="trend-body-content">
		<div class="trend-link">
			<a href="'.BASE_URL.'hashtag/'.$trend->hashtag.'">#'.$trend->hashtag.'</a>
		</div>
		<div class="trend-posts">
			'.$trend->postsCount.' <span>posts</span>
		</div>
	</div>
</div>';
			}
			echo '</div></div>';
		}

		public function getTweetsByHash($hashtag){
			$stmt = $this->pdo->prepare("SELECT * FROM `posts` LEFT JOIN `users` on `postBy` = `user_id` WHERE `status` LIKE :hashtag OR `repostMsg` LIKE  :hashtag ");
			$stmt->bindValue(":hashtag", '%#'.$hashtag.'%', PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);

		}
		public function getUsersByHash($hashtag){
			$stmt = $this->pdo->prepare("SELECT DISTINCT * FROM `posts` INNER JOIN `users` ON `postBy` = `user_id` WHERE `status` LIKE :hashtag OR `repostMsg` LIKE :hashtag GROUP BY `user_id`");
			$stmt->bindValue(":hashtag", '%#'.$hashtag.'%', PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

}


?>
