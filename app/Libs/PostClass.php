<?php

    namespace App\Libs;

    /**
    *	Post系の共通処理
    */
    class PostClass{

        public function getLikes(object $post) : object
        {
            $result = clone $post;


            //いいねをしたか？
            $PostLike = app("PostLike");
            $result->isLike = false;
            $postLike = $PostLike->getPost(\Auth::user()->id, $post->id)->first();
            if ($postLike){
                $result->isLike = true;
            }

            //フォローをしたか？
            $UserFollower = app("UserFollower");
            $result->user->isFollower = false;
            $userFollower = $UserFollower->getUser(\Auth::user()->id, $post->user->id)->first();
            if ($userFollower){
                $result->user->isFollower = true;
            }

            //リプライしたか？
            $PostReply = app("PostReply");
            $result->isReply = false;
            $userReply = $PostReply->getPost(\Auth::user()->id, $post->id)->first();
            if ($userReply){
                $result->isReply = true;
            }

            return $result;

        }
    }
