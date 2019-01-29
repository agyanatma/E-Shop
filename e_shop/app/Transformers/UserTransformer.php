<?php

namespace App\Transformers;

use App\User;
use App\Transformers\OrderTransformer;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'order'
    ];

    public function transform(User $user){
        return [
            'id' =>$user->id,
            'email' =>$user->email,
            'fullname' =>$user->fullname,
            'address' =>$user->address,
            'city' =>$user->city,
            'postal_code' =>$user->postal_code,
            'profile_image' =>'/upload/'.$user->profile_image,
        ];
    }

    public function includeOrder(User $user){
        $order = $user->order;
        return $this->collection($order, new OrderTransformer);
    }

}