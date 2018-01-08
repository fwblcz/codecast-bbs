<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    //在授权策略的类方法里，返回 true 即允许访问，反之返回 false 为拒绝访问
//    public function update(User $user, Topic $topic)
//    {
//         return $topic->user_id == $user->id;
//    }
//
//    public function destroy(User $user, Topic $topic)
//    {
//        return $topic->user_id == $user->id;
//    }
    public function update(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
    }

    public function destroy(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
    }
}
